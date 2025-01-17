@extends('layout.mainlayout')

@section('title', 'Edit Classroom')

@section('content')

   <div class="mt-5 col-6 m-auto">
    <div class="mt-5 col-6 m-auto">
            @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
            @endif

        <form action="/classroom/{{ $class->id }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name">Class Name</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ $class->name }}" required>
            </div>

            <div class="mb-3">
                    <label for="teacher">Teacher</label>
                    <select name="teacher_id" id="teacher" class="form-control">
                        <option value="">Empty</option>
                        @foreach ($teacher as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

            <div class="mt-5 d-flex gap-4">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="/classroom" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
   </div>

@endsection

    