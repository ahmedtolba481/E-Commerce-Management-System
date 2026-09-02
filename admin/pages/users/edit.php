<?php
include '../../includes/auth.php';
require_admin_role();
$pageTitle = "Add User | SmartStore";
$pageKey = "users";

include '../../includes/header.php';
include '../../includes/navbar.php';
include '../../../config/database.php';

$id = (int) ($_GET['id'] ?? 0);

    $sql = "SELECT * FROM users WHERE id = $id";

    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_array($result);

if (isset($_POST['submit'])) {

    

    $name = $_POST["name"];
    $role = $_POST["role"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (!in_array($role, ['Admin', 'Staff', 'Client'], true)) {
        echo "Invalid role selected.";
        exit;
    }

    if ($password === "") {
        $sql = "UPDATE users SET name = ?, role = ?, email = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssi", $name, $role, $email, $id);
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET name = ?, role = ?, email = ?, password = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssi", $name, $role, $email, $hashedPassword, $id);
    }

    if (mysqli_stmt_execute($stmt)) {

        header("Location: index.php");
        exit;

    } else {

        echo "Error: " . mysqli_error($conn);

    }
}

?>

<div class="admin-layout">

    <?php include '../../includes/sidebar.php'; ?>

    <main class="admin-content">

        

        <div class="page-header">

            <div>

                <div class="page-eyebrow">
                    User Management
                </div>

                <h1>Add User</h1>

                <p>
                    Edit User.
                </p>

            </div>

        </div>


        

        <div class="form-card">

            <div class="form-header">

                <div class="section-eyebrow">
                    User Information
                </div>

                <h2>Edit User</h2>

                <p>
                    Enter the user's information below.
                </p>

            </div>


            <form method="POST">

                <div class="form-body">

                    <div class="row">


                        

                        <div class="col-md-6">

                            <div class="form-group">

                                <label
                                    for="name"
                                    class="form-label"
                                >
                                    Full Name <span>*</span>
                                </label>

                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    class="form-input"
                                    value="<?php echo $user['name']?>"
                                    placeholder="Enter full name"
                                    required
                                >

                            </div>

                        </div>


                        

                        <div class="col-md-6">

                            <div class="form-group">

                                <label
                                    for="email"
                                    class="form-label"
                                >
                                    Email Address <span>*</span>
                                </label>

                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    class="form-input"
                                    value="<?php echo $user['email']?>"
                                    placeholder="Enter email address"
                                    required
                                >

                            </div>

                        </div>


                        

                        <div class="col-md-6">

                            <div class="form-group">

                                <label
                                    for="password"
                                    class="form-label"
                                >
                                    Password <span>*</span>
                                </label>

                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    class="form-input"
                                    placeholder="Enter password"
                                >

                                <small class="form-help">
                                    Choose a strong password for this account.
                                </small>

                            </div>

                        </div>


                        

                        <div class="col-md-6">

                            <div class="form-group">

                                <label
                                    for="role"
                                    class="form-label"
                                >
                                    User Role <span>*</span>
                                </label>

                                <select
                                    id="role"
                                    name="role"
                                    class="form-select"
                                    required
                                >

                                    <option value="">
                                        Select user role
                                    </option>

                                    <option value="Admin">
                                        Administrator
                                    </option>
                                    <option value="Client">
                                        Client
                                    </option>
                                    <option value="Staff">
                                        Staff
                                    </option>

                                </select>

                            </div>

                        </div>

                    </div>

                </div>


                

                <div class="form-footer">

                    <a
                        href="index.php"
                        class="btn-secondary"
                    >
                        <i class="bi bi-arrow-left"></i>
                        Cancel
                    </a>

                    <button
                        type="submit"
                        name="submit"
                        class="btn-primary"
                    >
                        <i class="bi bi-person-plus"></i>
                        Edit User
                    </button>

                </div>

            </form>

        </div>

    </main>

</div>


<?php include('../../includes/footer.php'); ?>