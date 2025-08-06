@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Subject</h3>
                    <div class="card-tools">
                        <a href="{{ route('subjects.show', $subject->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-arrow-left"></i> Back to Details
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('subjects.update', $subject->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="subject_code">Subject Code</label>
                                    <input type="text" class="form-control" id="subject_code" name="subject_code" 
                                           value="{{ old('subject_code', $subject->subject_code) }}" required>
                                    @error('subject_code')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="subject_name">Subject Name</label>
                                    <input type="text" class="form-control" id="subject_name" name="subject_name" 
                                           value="{{ old('subject_name', $subject->subject_name) }}" required>
                                    @error('subject_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="department">Department</label>
                                    <input type="text" class="form-control" id="department" name="department" 
                                           value="{{ old('department', $subject->department) }}" required>
                                    @error('department')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="year_level">Year Level</label>
                                    <input type="text" class="form-control" id="year_level" name="year_level" 
                                           value="{{ old('year_level', $subject->year_level) }}" required>
                                    @error('year_level')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="semester">Semester</label>
                                    <input type="text" class="form-control" id="semester" name="semester" 
                                           value="{{ old('semester', $subject->semester) }}" required>
                                    @error('semester')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="units">Units</label>
                                    <input type="number" class="form-control" id="units" name="units" 
                                           value="{{ old('units', $subject->units) }}" min="1" max="10" required>
                                    @error('units')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="school_year">School Year</label>
                                    <input type="text" class="form-control" id="school_year" name="school_year" 
                                           value="{{ old('school_year', $subject->school_year) }}" required>
                                    @error('school_year')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('subjects.show', $subject->id) }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Update Subject
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
