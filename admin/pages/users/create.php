<?php

$pageTitle = "Add User | SmartStore";
$pageKey = "users";

include('../../includes/header.php');
include('../../includes/navbar.php');
include('../../includes/database.php');


if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $sql = "INSERT INTO users (name, email, password, role)
            VALUES ('$name', '$email', '$password', '$role')";

    if (mysqli_query($connection, $sql)) {

        header("Location: index.php");
        exit;

    } else {

        echo "Error: " . mysqli_error($connection);

    }
}

?>

<div class="admin-layout">

    <?php include('../../includes/sidebar.php'); ?>

    <main class="admin-content">

        

        <div class="page-header">

            <div>

                <div class="page-eyebrow">
                    User Management
                </div>

                <h1>Add User</h1>

                <p>
                    Create a new user account for the system.
                </p>

            </div>

        </div>


        

        <div class="form-card">

            <div class="form-header">

                <div class="section-eyebrow">
                    User Information
                </div>

                <h2>Create New User</h2>

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
                                    required
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

                                    <option value="admin">
                                        Administrator
                                    </option>

                                    <option value="staff">
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
                        Create User
                    </button>

                </div>

            </form>

        </div>

    </main>

</div>


<?php include('../../includes/footer.php'); ?>