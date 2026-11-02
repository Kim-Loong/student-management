<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Student - Split Screen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-side {
            background-color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 2rem 0;
        }
        .form-wrapper {
            width: 100%;
            max-width: 500px;
            padding: 2rem;
        }
        .brand-side {
            background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            min-height: 100vh;
            position: sticky;
            top: 0;
        }
    </style>
</head>
<body>
<div class="container-fluid p-0">
    <div class="row g-0">
        <!-- Left Side: Branding (Hidden on mobile) -->
        <div class="col-lg-6 d-none d-lg-flex brand-side">
            <div class="text-center px-5">
                <h1 class="display-4 fw-bold mb-4">Update Profile</h1>
                <p class="lead">Modify the student's records carefully. Ensure all academic and personal details are kept up to date.</p>
            </div>
        </div>
        
        <!-- Right Side: Edit Student Form -->
        <div class="col-lg-6 form-side">
            <div class="form-wrapper">
                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold mb-0">Edit Details</h2>
                    <a href="{{ route('students.index') }}" class="btn btn-outline-secondary btn-sm">← Directory</a>
                </div>
                
                @if($errors->any())
                    <div class="alert alert-danger py-2">
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form action="{{ route('students.update', $student->student_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label class="form-label text-muted fw-semibold">Student Name</label>
                        <input type="text" name="student_name" class="form-control form-control-lg bg-light border-0" value="{{ old('student_name', $student->student_name) }}" placeholder="Full Name" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label text-muted fw-semibold">Email Address</label>
                        <input type="email" name="email" class="form-control form-control-lg bg-light border-0" value="{{ old('email', $student->email) }}" placeholder="student@example.com" required>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted fw-semibold">Gender</label>
                            <select name="gender" class="form-select form-select-lg bg-light border-0" required>
                                <option value="Male" {{ old('gender', $student->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender', $student->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Other" {{ old('gender', $student->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted fw-semibold">Enrollment Date</label>
                            <input type="date" name="enrollment_date" class="form-control form-control-lg bg-light border-0" value="{{ old('enrollment_date', $student->enrollment_date) }}" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label text-muted fw-semibold">Department</label>
                        <select name="dept_id" class="form-select form-select-lg bg-light border-0" required>
                            @foreach($departments as $dept)
                                <option value="{{ $dept->dept_id }}" {{ old('dept_id', $student->dept_id) == $dept->dept_id ? 'selected' : '' }}>
                                    {{ $dept->dept_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label text-muted fw-semibold">Description (Optional)</label>
                        <textarea name="description" class="form-control form-control-lg bg-light border-0" rows="3" placeholder="Additional notes...">{{ old('description', $student->description) }}</textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">Update Student</button>
                </form>
                
            </div>
        </div>
    </div>
</div>
</body>
</html>