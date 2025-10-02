<x-admin-component>

<style>
body {
    font-family: Arial, sans-serif;
    color: #333;
}

/* Card design */
.glass-card {
    background: rgba(255,255,255,0.7);
    backdrop-filter: blur(15px);
    border-radius: 20px;
    padding: 25px;
    border: 1px solid rgba(255,255,255,0.4);
    box-shadow: 0 8px 32px rgba(0,0,0,0.1);
    margin-bottom: 30px;
    transition: 0.3s ease-in-out;
}

.glass-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 40px rgba(0,0,0,0.15);
}

/* Search + Filter */
.search-bar {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
}

.search-bar input, 
.search-bar select {
    flex: 1;
    padding: 8px;
    border-radius: 8px;
    border: 1px solid #ccc;
}

.search-bar button {
    flex: 0.3;
    border-radius: 8px;
}

/* Table */
.glass-table {
    width: 100%;
    border-collapse: collapse;
    color: #333;
    border-radius: 10px;
    overflow: hidden;
}

.glass-table thead {
    background: rgba(0, 0, 0, 0.05);
    font-weight: bold;
}

.glass-table tbody tr {
    background: rgba(255,255,255,0.6);
    transition: 0.2s;
}

.glass-table tbody tr:hover {
    background: rgba(255,255,255,0.9);
}

.glass-table th,
.glass-table td {
    padding: 12px;
    text-align: left;
    vertical-align: middle;
}

/* Action buttons */
.action-group {
    display: flex;
    gap: 6px;
}

.action-btn {
    flex: 1;
    padding: 6px 10px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    color: white;
    font-size: 0.8rem;
    transition: 0.2s;
}

.edit-btn { background: #3498db; }
.edit-btn:hover { background: #2980b9; }

.suspend-btn { background: #e67e22; }
.suspend-btn:hover { background: #ca6f1e; }

.delete-btn { background: #e74c3c; }
.delete-btn:hover { background: #c0392b; }
</style>

<div class="glass-card">
    <h3>Parent List / Directory</h3>

    <!-- Search + Filter -->
    <form class="search-bar">
        <input type="text" placeholder="Search by parent name, email or student...">
        <button type="button" class="action-btn edit-btn">Filter</button>
    </form>

    <!-- Parent Table -->
    <table class="glass-table">
        <thead>
            <tr>
                <th>Parent ID</th>
                <th>Name</th>
                <th>Username</th>
                <th>Linked Student</th>
                <th style="width: 200px;">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($parents as $parent)
            <tr>
                <td>{{ $parent->id }}</td>
                <td>{{ $parent->name }}</td>
                <td>{{ $parent->username }}</td>
                <td>
                    @if($parent->profile && $parent->profile->students->count() > 0)
                        @foreach($parent->profile->students as $studentProfile)
                            {{ $studentProfile->user->name }} ({{ $studentProfile->user->username }})
                            @if(!$loop->last), @endif
                        @endforeach
                    @else
                        No linked student
                    @endif
                </td>
                <td>
                    <div class="action-group">
                        <button class="action-btn edit-btn">Edit</button>
                     
                        <form method="POST" action="{{ route('admin.parent.destroy', $parent->id) }}" onsubmit="return confirm('Are you sure you want to delete this parent?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn delete-btn">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">No parent accounts found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

</x-admin-component>
