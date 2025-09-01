<x-parent-component>
    <div class="container mt-4">
        <h3 class="page-header">📊 Quiz & Exam Results</h3>

        <!-- Results Table -->
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Child's Performance Summary</h5>
                <p class="text-muted">Here’s a quick look at recent quiz and exam results:</p>

                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Subject</th>
                            <th>Quiz Average</th>
                            <th>Exam Score</th>
                            <th>Overall</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Mathematics</td>
                            <td>85%</td>
                            <td>88%</td>
                            <td><span class="badge bg-success">Good</span></td>
                            <td>Improved problem-solving skills</td>
                        </tr>
                        <tr>
                            <td>English</td>
                            <td>90%</td>
                            <td>92%</td>
                            <td><span class="badge bg-primary">Excellent</span></td>
                            <td>Great in writing tasks</td>
                        </tr>
                        <tr>
                            <td>Science</td>
                            <td>78%</td>
                            <td>80%</td>
                            <td><span class="badge bg-warning text-dark">Needs Focus</span></td>
                            <td>Should review lab concepts</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-parent-component>
