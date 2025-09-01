<x-parent-component>
    <div class="container mt-4">
        <h3 class="page-header">🏆 Final Grades</h3>

        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Child's Final Report</h5>
                <p class="text-muted">Summary of your child's performance at the end of the grading period.</p>

                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Subject</th>
                            <th>Final Grade</th>
                            <th>Equivalent</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Mathematics</td>
                            <td>88</td>
                            <td>Very Good</td>
                            <td>Shows strong analytical skills</td>
                        </tr>
                        <tr>
                            <td>English</td>
                            <td>92</td>
                            <td>Excellent</td>
                            <td>Outstanding in writing & reading</td>
                        </tr>
                        <tr>
                            <td>Science</td>
                            <td>80</td>
                            <td>Satisfactory</td>
                            <td>Needs focus on experiments</td>
                        </tr>
                        <tr class="table-primary">
                            <td><strong>General Average</strong></td>
                            <td><strong>87</strong></td>
                            <td><strong>Very Good</strong></td>
                            <td><strong>Passed</strong></td>
                        </tr>
                    </tbody>
                </table>

                <div class="alert alert-success mt-3">
                    🎉 Congratulations! Your child has successfully <strong>Passed</strong> this grading period.
                </div>
            </div>
        </div>
    </div>
</x-parent-component>
