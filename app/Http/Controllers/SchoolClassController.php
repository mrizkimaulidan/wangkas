<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchoolClass\StoreSchoolClassRequest;
use App\Repositories\SchoolClassRepository;
use Illuminate\Http\Request;

class SchoolClassController extends Controller
{
    public function __construct(
        private SchoolClassRepository $schoolClassRepository
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.school_classes.index', [
            'school_classes' => $this->schoolClassRepository->schoolClassesOrderBy('name')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSchoolClassRequest $request)
    {
        $this->schoolClassRepository->store($request);

        return redirect()->route('admin.kelas.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->schoolClassRepository->update($request, $id);

        return redirect()->route('admin.kelas.index')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $school_class = $this->schoolClassRepository->findSchoolClass($id);

        if ($school_class->students()->exists()) {
            return redirect()->route('admin.kelas.index')->with('warning', 'Data yang memiliki relasi tidak dapat dihapus!');
        }

        $school_class->delete();

        return redirect()->route('admin.kelas.index')->with('success', 'Data berhasil dihapus!');
    }
}
