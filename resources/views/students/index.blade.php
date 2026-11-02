<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Directory - Split Layout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: #f4f6f9; }
        
        .sidebar-brand {
            background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%);
            color: white;
            min-width: 280px;
            max-width: 280px;
        }

        .stat-card { 
            border-radius: 12px; 
            background: white; 
            border: none;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease-in-out;
        }
        .stat-card:hover { transform: translateY(-3px); }
        
        .stat-icon-wrapper {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .data-card {
            border-radius: 12px;
            border: none;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            background: white;
        }
        
        .table > :not(caption) > * > * {
            padding: 1rem 1.25rem;
        }

        @media (max-width: 991.98px) {
            .sidebar-brand {
                min-width: 100%;
                max-width: 100%;
                flex-direction: row !important;
                justify-content: space-between;
                align-items: center;
                padding: 1.5rem !important;
            }
            .sidebar-text { display: none; }
        }
    </style>
</head>
<body>

<div class="d-flex flex-column flex-lg-row min-vh-100">
    
    <!-- Left Side: Branding / Sidebar -->
    <div class="sidebar-brand p-4 d-flex flex-column shadow">
        <div class="mb-lg-5">
            <h3 class="fw-bold mb-0 d-flex align-items-center gap-2">
                <i class="bi bi-mortarboard-fill"></i> EduPortal
            </h3>
            <p class="text-white-50 mt-2 small sidebar-text">Academic Management System</p>
        </div>
        
        <div class="mt-auto sidebar-text w-100">
            <div class="bg-white bg-opacity-10 rounded p-3 text-white">
                <h6 class="fw-bold mb-1">Signed in as Admin</h6>
                <div class="d-flex gap-2 mt-3">
                    <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-light text-primary w-100">Profile</a>
                    <form action="{{ route('logout') }}" method="POST" class="w-100">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-light w-100">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Side: Main Data View -->
    <div class="flex-grow-1 p-4 p-md-5">
        <div class="container-fluid p-0" style="max-width: 1200px;">
            
            <!-- Header -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
                <div>
                    <h3 class="fw-bold text-dark mb-1">Student Directory</h3>
                    <p class="text-muted mb-0">Overview and management of enrolled students</p>
                </div>
                <div>
                    <a href="{{ route('students.create') }}" class="btn btn-primary px-4 py-2 shadow-sm fw-medium">
                        <i class="bi bi-plus-lg me-1"></i> Add New Student
                    </a>
                </div>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm rounded-3 mb-4 alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Stats Section -->
            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="stat-card p-4 d-flex align-items-center h-100">
                        <div class="stat-icon-wrapper bg-primary bg-opacity-10 text-primary fs-3 me-3">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <div>
                            <h2 class="mb-0 fw-bold text-dark">{{ $totalStudents ?? 0 }}</h2>
                            <small class="text-muted fw-semibold text-uppercase" style="letter-spacing: 1px;">Total Students</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card p-4 d-flex align-items-center h-100">
                        <div class="stat-icon-wrapper bg-success bg-opacity-10 text-success fs-3 me-3">
                            <i class="bi bi-building-fill"></i>
                        </div>
                        <div>
                            <h2 class="mb-0 fw-bold text-dark">{{ $totalDepartments ?? 0 }}</h2>
                            <small class="text-muted fw-semibold text-uppercase" style="letter-spacing: 1px;">Departments</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card p-4 d-flex align-items-center h-100">
                        <div class="stat-icon-wrapper bg-warning bg-opacity-10 text-warning fs-3 me-3">
                            <i class="bi bi-clock-fill"></i>
                        </div>
                        <div>
                            <h2 class="mb-0 fw-bold text-dark">{{ $avgYears ?? 0 }} yrs</h2>
                            <small class="text-muted fw-semibold text-uppercase" style="letter-spacing: 1px;">Avg. Enrollment</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search & Filter Bar -->
            <div class="data-card mb-4 p-3">
                <form action="{{ route('students.index') }}" method="GET" class="row g-2 align-items-center">
                    <div class="col-12 col-md-4">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0"><i class="bi bi-search text-muted"></i></span>
                            <input type="text" name="search" class="form-control bg-light border-0" placeholder="Search by name or email..." value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <select name="dept_id" class="form-select bg-light border-0">
                            <option value="">All Departments</option>
                            @if(isset($departments))
                                @foreach($departments as $dept)
                                    <option value="{{ $dept->dept_id }}" {{ request('dept_id') == $dept->dept_id ? 'selected' : '' }}>
                                        {{ $dept->dept_name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-6 col-md-2">
                        <select name="gender" class="form-select bg-light border-0">
                            <option value="">All Genders</option>
                            <option value="Male" {{ request('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ request('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ request('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-dark w-100 fw-medium">Filter</button>
                        <a href="{{ route('students.index') }}" class="btn btn-light text-secondary w-100 fw-medium border-0">Reset</a>
                    </div>
                </form>
            </div>

            <!-- Students Table -->
            <div class="data-card overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 text-nowrap">
                        <thead class="table-light">
                            <tr>
                                <th class="text-muted fw-semibold text-uppercase" style="font-size: 0.85rem;">ID</th>
                                <th class="text-muted fw-semibold text-uppercase" style="font-size: 0.85rem;">Name</th>
                                <th class="text-muted fw-semibold text-uppercase" style="font-size: 0.85rem;">Email</th>
                                <th class="text-muted fw-semibold text-uppercase" style="font-size: 0.85rem;">Gender</th>
                                <th class="text-muted fw-semibold text-uppercase" style="font-size: 0.85rem;">Department</th>
                                <th class="text-muted fw-semibold text-uppercase" style="font-size: 0.85rem;">Enrolled</th>
                                <th class="text-muted fw-semibold text-uppercase" style="font-size: 0.85rem;">Years</th>
                                <th class="text-muted fw-semibold text-uppercase text-end" style="font-size: 0.85rem;">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="border-top-0">
                            @if(isset($students))
                                @forelse($students as $student)
                                    <tr>
                                        <td class="text-muted">#{{ $student->student_id }}</td>
                                        <td class="fw-semibold text-dark">{{ $student->student_name }}</td>
                                        <td class="text-muted">{{ $student->email }}</td>
                                        <td>
                                            <span class="badge {{ $student->gender == 'Male' ? 'bg-primary' : ($student->gender == 'Female' ? 'bg-danger' : 'bg-secondary') }} bg-opacity-10 text-dark fw-medium border">
                                                {{ $student->gender }}
                                            </span>
                                        </td>
                                        <td><span class="fw-medium text-dark">{{ $student->department->dept_name ?? 'N/A' }}</span></td>
                                        <td class="text-muted">{{ $student->enrollment_date }}</td>
                                        <td><span class="badge bg-light text-dark border">{{ $student->years_enrolled }}</span></td>
                                        <td class="text-end">
                                            <a href="{{ route('students.edit', $student->student_id) }}" class="btn btn-sm btn-light text-primary me-1"><i class="bi bi-pencil-square"></i> Edit</a>
                                            <form action="{{ route('students.destroy', $student->student_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this student?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-light text-danger"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-5">
                                            <div class="text-muted mb-2"><i class="bi bi-inbox fs-1"></i></div>
                                            <h6 class="fw-medium text-dark">No students found</h6>
                                            <p class="text-muted small mb-0">Try adjusting your search or filters.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            @else
                                <tr>
                                    <td colspan="8" class="text-center py-5 text-danger">Data source not provided.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                @if(isset($students) && $students->hasPages())
                    <div class="card-footer bg-white p-3 border-top">
                        {{ $students->withQueryString()->links() }}
                    </div>
                @endif
            </div>
            
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>