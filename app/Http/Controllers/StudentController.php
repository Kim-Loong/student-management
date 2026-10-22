<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Department;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // Index page with Search, Filter, and Statistics
    public function index(Request $request)
    {
        $query = Student::with('department');

        // Search by Name or Email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('student_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by Department
        if ($request->filled('dept_id')) {
            $query->where('dept_id', $request->dept_id);
        }

        // Filter by Gender
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        // Sorting
        $sort = $request->get('sort', 'newest');
        if ($sort === 'newest') {
            $query->orderBy('created_at', 'desc');
        } else {
            $query->orderBy('created_at', 'asc');
        }

        $students = $query->paginate(10);
        $departments = Department::all();

        // Statistics Cards
        $totalStudents = Student::count();
        $totalDepartments = Department::count();
        
        $avgDays = Student::all()->avg(function($s) {
            return \Carbon\Carbon::parse($s->enrollment_date)->diffInDays(now());
        });
        $avgYears = $avgDays ? number_format($avgDays / 365.25, 1) : 0;

        return view('students.index', compact(
            'students', 'departments', 'totalStudents', 'totalDepartments', 'avgYears'
        ));
    }

    // Show Create Form
    public function create()
    {
        $departments = Department::all();
        return view('students.create', compact('departments'));
    }

    // Store Student
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'gender' => 'required|in:Male,Female,Other',
            'enrollment_date' => 'required|date',
            'dept_id' => 'required|exists:departments,dept_id',
            'description' => 'nullable|string'
        ]);

        Student::create($validated);

        return redirect()->route('students.index')->with('success', 'Student registered successfully!');
    }

    // Show Edit Form
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $departments = Department::all();
        return view('students.edit', compact('student', 'departments'));
    }

    // Update Student
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $validated = $request->validate([
            'student_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $id . ',student_id',
            'gender' => 'required|in:Male,Female,Other',
            'enrollment_date' => 'required|date',
            'dept_id' => 'required|exists:departments,dept_id',
            'description' => 'nullable|string'
        ]);

        $student->update($validated);

        return redirect()->route('students.index')->with('success', 'Student updated successfully!');
    }

    // Delete Student
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }
}