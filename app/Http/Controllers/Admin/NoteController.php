<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyNoteRequest;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Models\Note;
use App\Models\Vendor;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class NoteController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('note_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Note::with(['vendor'])->select(sprintf('%s.*', (new Note())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'note_show';
                $editGate = 'note_edit';
                $deleteGate = 'note_delete';
                $crudRoutePart = 'notes';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('note', function ($row) {
                return $row->note ? $row->note : '';
            });
            $table->editColumn('title', function ($row) {
                return $row->note ? $row->note : '';
            });
            $table->addColumn('vendor_name', function ($row) {
                return $row->vendor ? $row->vendor->name : '';
            });

            $table->editColumn('file', function ($row) {
                if (!$row->file) {
                    return '';
                }
                $links = [];
                foreach ($row->file as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });

            $table->rawColumns(['actions', 'placeholder', 'vendor', 'file']);

            return $table->make(true);
        }

        $vendors = Vendor::get();

        return view('admin.notes.index', compact('vendors'));
    }

    public function create()
    {
        abort_if(Gate::denies('note_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vendors = Vendor::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.notes.create', compact('vendors'));
    }

    public function store(StoreNoteRequest $request)
    {
        $note = Note::create($request->all());

        foreach ($request->input('file', []) as $file) {
            $note->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('file');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $note->id]);
        }

        return back();
    }

    public function edit(Note $note,Request $request)
    {
        abort_if(Gate::denies('note_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vendors = Vendor::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $note->load('vendor');

        return view('admin.notes.edit', compact('note', 'vendors','request'));
    }

    public function update(UpdateNoteRequest $request, Note $note)
    {
        $note->update($request->all());

        if (count($note->file) > 0) {
            foreach ($note->file as $media) {
                if (!in_array($media->file_name, $request->input('file', []))) {
                    $media->delete();
                }
            }
        }
        $media = $note->file->pluck('file_name')->toArray();
        foreach ($request->input('file', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $note->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('file');
            }
        }

        return redirect()->route('admin.vendors.show',$request->vendor_id);
    }

    public function show(Note $note)
    {
        abort_if(Gate::denies('note_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $note->load('vendor');

        return view('admin.notes.show', compact('note'));
    }

    public function destroy(Note $note)
    {
        abort_if(Gate::denies('note_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $note->delete();

        return back();
    }

    public function massDestroy(MassDestroyNoteRequest $request)
    {
        Note::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('note_create') && Gate::denies('note_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Note();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
