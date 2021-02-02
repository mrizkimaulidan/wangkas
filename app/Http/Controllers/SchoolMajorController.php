<?php

namespace App\Http\Controllers;

use App\Repositories\SchoolMajorRepository;
use Illuminate\Http\Request;

class SchoolMajorController extends Controller
{
    public function __construct(
        private SchoolMajorRepository $schoolMajorRepository
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.school_majors.index', [
            'school_majors' => $this->schoolMajorRepository->schoolMajorsOrderBy('name')->get()
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
    public function store(Request $request)
    {
        $this->schoolMajorRepository->store($request);

        return redirect()->route('admin.jurusan.index')->with('success', 'Data berhasil ditambahkan!');
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
        $this->schoolMajorRepository->update($request, $id);

        return redirect()->route('admin.jurusan.index')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->schoolMajorRepository->findSchoolMajor($id)->delete();

        return redirect()->route('admin.jurusan.index')->with('success', 'Data berhasil dihapus!');
    }
}
