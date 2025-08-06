@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Subject Details</h3>
                    <div class="card-tools">
                        <a href="{{ route('upload.subjects') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-arrow-left"></i> Back to Subjects
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Subject Code</th>
                                    <td>{{ $subject->subject_code }}</td>
                                </tr>
                                <tr>
                                    <th>Subject Name</th>
                                    <td>{{ $subject->subject_name }}</td>
                                </tr>
                                <tr>
                                    <th>Department</th>
                                    <td>{{ $subject->department }}</td>
                                </tr>
                                <tr>
                                    <th>Year Level</th>
                                    <td>{{ $subject->year_level }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Semester</th>
                                    <td>{{ $subject->semester }}</td>
                                </tr>
                                <tr>
                                    <th>Units</th>
                                    <td>{{ $subject->units }}</td>
                                </tr>
                                <tr>
                                    <th>School Year</th>
                                    <td>{{ $subject->school_year }}</td>
                                </tr>
                                <tr>
                                    <th>Created</th>
                                    <td>{{ $subject->created_at->format('M d, Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('upload.subjects') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Back to List
                                </a>
                                <div>
                                    <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this subject?')">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
