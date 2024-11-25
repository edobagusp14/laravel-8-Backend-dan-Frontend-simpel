<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <style>
        #userModal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
    }
         button {
            margin: 0 5px;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
        }

        .edit-btn {
            background-color: #4CAF50;
            color: white;
        }

        .delete-btn {
            background-color: #f44336;
            color: white;
        }
            ul, ol {
            margin: 20px 0;
            padding: 0;
            list-style-type: none;
        }

        li {
            margin: 5px 0;
            padding: 10px;
            background-color: #f4f4f4;
            border: 1px solid #ddd;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        #loading {
            font-size: 18px;
            font-weight: bold;
        }
    </style>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const token = localStorage.getItem('access_token');
            
            if (!token) {
                // Redirect to login if not authenticated
                window.location.href = "{{ url('/login') }}";
            }

            // Example of fetching protected data
            fetch('http://127.0.0.1:8000/api/auth/user', {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
                },
            })
            .then(response => response.json())
            
            .then(data => {
                document.getElementById('data').textContent = JSON.stringify(data.name);
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Session expired. Please log in again.');
                window.location.href = "{{ url('/login') }}";
            });
        });
 

        function logout() {
            const token = localStorage.getItem('access_token');

            fetch('http://127.0.0.1:8000/api/auth/logout', {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`,
                },
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                localStorage.removeItem('access_token');
                window.location.href = "{{ url('/login') }}";
            })
            .catch(error => console.error('Error:', error));
        }
    </script>

</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <h1>Welcome to Index Page</h1>
    <div id="data">Loading protected data...</div>

 
    <button class="create-btn" onclick="logout()">logout</button>
    <button class="create-btn" onclick="createUser()">Create</button>

<!-- Modal -->
<div id="userModal" style="display: none;">
    <div style="background: white; padding: 20px; border-radius: 10px; width: 400px; margin: 100px auto;">
        <h3 id="modalTitle"></h3>
        <form id="userForm">
            <input type="hidden" id="userId" />
            <input type="hidden" id="user_id" />
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" required />
            </div>
            <div>
                <label for="gender">Gender:</label>
                <select id="gender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div>
                <label for="job">Job Position:</label>
                <input type="text" id="job" required />
            </div>
            <div>
                <label for="address">Address:</label>
                <input type="text" id="address" required />
            </div>
            <div>
                <label for="birthDate">Birth Date:</label>
                <input type="date" id="birthDate" required />
            </div>
            <button type="submit" id="saveButton">Save</button>
            <button type="button" onclick="closeModal()">Cancel</button>
        </form>
    </div>
</div>

    <table id="userTable">

        <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>jenis kelamin</th>
                <th>jabatan</th>
                <th>alamat</th>
                <th>Tanggal lahir</th>
                <th>aksi</th>
            </tr>
        </thead>
        <tbody></tbody>
            <!-- Data will be inserted here -->
        
    </table>
    
 <!--  Add  model-->
 <div class="modal fade in" id="myModalone" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <form id="submitForm" >
                    <div class="modal-body">
                        <h2>Create New Record</h2>
                        <div class="form-example-wrap">
                            <div class="form-example-int">
                                <div class="form-group">
                                    <label>Name</label>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control input-sm" placeholder="Enter Name" name="name">
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int">
                                <div class="form-group">
                                    <label>Position</label>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control input-sm" placeholder="Enter Position" name="position">
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int">
                                <div class="form-group">
                                    <label>Office</label>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control input-sm" placeholder="Enter Office" name="office">
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int">
                                <div class="form-group">
                                    <label>Age</label>
                                    <div class="nk-int-st">
                                        <input type="number" class="form-control input-sm" placeholder="Enter Age" name="age">
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int">
                                <div class="form-group">
                                    <label>Salary</label>
                                    <div class="nk-int-st">
                                        <input type="number" class="form-control input-sm" placeholder="Enter Salary" name="salary">
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int">
                                <div class="form-group">
                                    <label>Start date</label>
                                    <div class="nk-int-st">
                                        <input type="date" class="form-control" data-mask="99/99/9999" placeholder="dd/mm/yyyy"  name="start_date">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default">Save changes</button>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" id="close">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--  Edit  model-->
    <div class="modal fade in" id="editModel" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <form id="updateForm" >
                    <input type="hidden" name="id" id="id">
                    <div class="modal-body">
                        <h2>Edit Record</h2>
                        <div class="form-example-wrap">
                            <div class="form-example-int">
                                <div class="form-group">
                                    <label>Name</label>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control input-sm" placeholder="Enter Name" name="name" id="name">
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int">
                                <div class="form-group">
                                    <label>Position</label>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control input-sm" placeholder="Enter Position" name="position" id="position">
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int">
                                <div class="form-group">
                                    <label>Office</label>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control input-sm" placeholder="Enter Office" name="office" id="office">
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int">
                                <div class="form-group">
                                    <label>Age</label>
                                    <div class="nk-int-st">
                                        <input type="number" class="form-control input-sm" placeholder="Enter Age" name="age" id="age">
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int">
                                <div class="form-group">
                                    <label>Salary</label>
                                    <div class="nk-int-st">
                                        <input type="number" class="form-control input-sm" placeholder="Enter Salary" name="salary" id="salary">
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int">
                                <div class="form-group">
                                    <label>Start date</label>
                                    <div class="nk-int-st">
                                        <input type="date" class="form-control" data-mask="99/99/9999" placeholder="dd/mm/yyyy"  name="start_date" id="start_date">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default">Save changes</button>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" id="closeBtn">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    
<!-- chatgpt -->
<script>
    // URL API Laravel
          const apiURL = 'http://127.0.0.1:8000/api/karyawan'; // Sesuaikan dengan URL API Anda
           const token = localStorage.getItem('access_token');
            
            if (!token) {
                // Redirect to login if not authenticated
                window.location.href = "{{ url('/login') }}";
            }

    fetch(apiURL, {
        method: 'GET',
        headers: {
            'Authorization': `Bearer ${token}`,
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Failed to fetch data');
        }
        return response.json();
    })
    .then(json => {
        if (Array.isArray(json.data)) { // Pastikan json.data adalah array
            json.data.forEach(user => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${user.id}</td>
                    <td>${user.nama}</td>
                    <td>${user.jeniskelamin}</td>
                    <td>${user.jabatan}</td>
                    <td>${user.alamat}</td>
                    <td>${user.tgl_lahir}</td>
                        <td>
                            <button class="edit-btn" onclick="editUser(${user.id})">Edit</button>
                            <button class="delete-btn" onclick="deleteUser(${user.id})">Delete</button>
                        </td>
                `;
                document.getElementById('userTable').appendChild(row);
            });
        } else {
            console.error('Data is not an array');
        }
    })
   
    .catch(error => {
        console.error('Error:', error);
    });

    function openModal(isEdit, userData = {}) {
    document.getElementById('userModal').style.display = 'block';
    document.getElementById('modalTitle').innerText = isEdit ? 'Edit User' : 'Create User';
    document.getElementById('saveButton').innerText = isEdit ? 'Update' : 'Create';

    // Isi form jika edit, kosongkan jika create
    document.getElementById('userId').value = isEdit ? userData.id : '';
    document.getElementById('name').value = isEdit ? userData.nama : '';
    document.getElementById('gender').value = isEdit ? userData.jeniskelamin : '';
    document.getElementById('user_id').value = isEdit ? userData.user_id : '';
    document.getElementById('job').value = isEdit ? userData.jabatan : '';
    document.getElementById('address').value = isEdit ? userData.alamat : '';
    document.getElementById('birthDate').value = isEdit ? userData.tgl_lahir : '';
}

function closeModal() {
    document.getElementById('userModal').style.display = 'none';
    document.getElementById('userForm').reset();
}

// Tangani submit form
document.getElementById('userForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const token = localStorage.getItem('access_token');
    const id = document.getElementById('userId').value;
    const url = id 
        ? `http://127.0.0.1:8000/api/karyawan/edit/${id}` 
        : 'http://127.0.0.1:8000/api/karyawan/store';

    const method = id ? 'PUT' : 'POST';

    const body = {
        nama: document.getElementById('name').value,
        jeniskelamin: document.getElementById('gender').value,
        jabatan: document.getElementById('job').value,
        alamat: document.getElementById('address').value,
        tgl_lahir: document.getElementById('birthDate').value
    };

    fetch(url, {
        method: method,
        headers: {
            'Authorization': `Bearer ${token}`,
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(body)
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        closeModal();
        location.reload(); // Reload halaman setelah operasi selesai
    })
    .catch(error => console.error('Error:', error));
});

// Fungsi untuk membuka modal dalam mode create
function createUser() {
    openModal(false);
}

// Fungsi untuk membuka modal dalam mode edit
function editUser(id) {
    const token = localStorage.getItem('access_token');
    fetch(`http://127.0.0.1:8000/api/karyawan/show/${id}`, {
        method: 'GET',
        headers: {
            'Authorization': `Bearer ${token}`,
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(json => {
    const userData = json.data; // Jika data berada di dalam json.data
    openModal(true, userData);
})
    
    .catch(error => console.error('Error:', error));
}

    
    function deleteUser(id) {   
            if (confirm('Are you sure you want to delete this user?')) {
                const token = localStorage.getItem('access_token');
                fetch(`http://127.0.0.1:8000/api/karyawan/delete/${id}`, {                    
                    method: 'DELETE',
                    headers: {
                                'Authorization': `Bearer ${token}`,
                                'Content-Type': 'application/json'
                            }
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    location.reload(); // Reload halaman setelah delete
                })
                .catch(error => console.error('Error:', error));
            }
        }
</script>

</body>
</html>
