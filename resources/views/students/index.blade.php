<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Directory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; }
        .stat-card { border-radius: 10px; background: white; border: 1px solid #eef0f3; }
    </style>
</head>
<body class="py-4">
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0">Student Directory</h3>
            <p class="text-muted mb-0">Browse and manage all registered students</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('students.create') }}" class="btn btn-primary">+ Add New Student</a>
            <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary">Edit Profile</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-danger">Logout</button>
            </form>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="stat-card p-3 d-flex align-items-center">
                <div class="fs-1 text-primary me-3"><i class="bi bi-people"></i></div>
                <div>
                    <h2 class="mb-0 fw-bold">{{ $totalStudents }}</h2>
                    <small class="text-muted">Total Students</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card p-3 d-flex align-items-center">
                <div class="fs-1 text-success me-3"><i class="bi bi-building"></i></div>
                <div>
                    <h2 class="mb-0 fw-bold">{{ $totalDepartments }}</h2>
                    <small class="text-muted">Departments</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card p-3 d-flex align-items-center">
                <div class="fs-1 text-warning me-3"><i class="bi bi-clock-history"></i></div>
                <div>
                    <h2 class="mb-0 fw-bold">{{ $avgYears }} yrs</h2>
                    <small class="text-muted">Avg. Enrollment Duration</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Search & Filter Bar -->
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-body">
            <form action="{{ route('students.index') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Search by name or email..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="dept_id" class="form-select">
                        <option value="">All Departments</option>
                        @foreach($departments as $dept)
                            <option value="{{ $dept->dept_id }}" {{ request('dept_id') == $dept->dept_id ? 'selected' : '' }}>
                                {{ $dept->dept_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="gender" class="form-select">
                        <option value="">All Genders</option>
                        <option value="Male" {{ request('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ request('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="Other" {{ request('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-dark w-100">Filter</button>
                    <a href="{{ route('students.index') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Students Table -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Department</th>
                            <th>Enrollment Date</th>
                            <th>Years Enrolled</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $student)
                            <tr>
                                <td>{{ $student->student_id }}</td>
                                <td class="fw-semibold">{{ $student->student_name }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->gender }}</td>
                                <td>{{ $student->department->dept_name ?? 'N/A' }}</td>
                                <td>{{ $student->enrollment_date }}</td>
                                <td>{{ $student->years_enrolled }}</td>
                                <td class="text-end">
                                    <a href="{{ route('students.edit', $student->student_id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <form action="{{ route('students.destroy', $student->student_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this student?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">No students found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="mt-3">
        {{ $students->withQueryString()->links() }}
    </div>
</div>
</body>
</html>