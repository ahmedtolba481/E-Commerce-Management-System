<?php

include "../../config/database.php";

$error = "";

$name = "";
$position = "";
$description = "";
$facebook = "";
$instagram = "";
$linkedin = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"]);
    $position = trim($_POST["position"]);
    $description = trim($_POST["description"]);
    $facebook = trim($_POST["facebook"]);
    $instagram = trim($_POST["instagram"]);
    $linkedin = trim($_POST["linkedin"]);

    if ($name == "" || $position == "") {

        $error = "Name and position are required.";

    } else {

        $image = "";

        if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {

            $image = time() . "_" . $_FILES["image"]["name"];

            move_uploaded_file(
                $_FILES["image"]["tmp_name"],
                "../assets/images/team/" . $image
            );
        }

        $query = mysqli_prepare(
            $conn,
            "INSERT INTO team
            (name, position, description, image, facebook, instagram, linkedin)
            VALUES (?, ?, ?, ?, ?, ?, ?)"
        );

        mysqli_stmt_bind_param(
            $query,
            "sssssss",
            $name,
            $position,
            $description,
            $image,
            $facebook,
            $instagram,
            $linkedin
        );

        mysqli_stmt_execute($query);

        header("Location: index.php");
        exit;
    }
}

include "../includes/header.php";
?>
<link rel="stylesheet" href="../assets/css/team.css">
<?php
include "../includes/navbar.php";
include "../includes/sidebar.php";

?>

<div class="team-page">

    <h2 class="mb-4">Add Team Member</h2>

    <?php if ($error != "") { ?>

        <div class="alert alert-danger">
            <?= $error ?>
        </div>

    <?php } ?>

    <form method="POST" enctype="multipart/form-data">

        <div class="mb-3">
            <label class="form-label">Name</label>

            <input
                type="text"
                name="name"
                class="form-control"
                value="<?= htmlspecialchars($name) ?>"
                required>
        </div>


        <div class="mb-3">
            <label class="form-label">Position</label>

            <input
                type="text"
                name="position"
                class="form-control"
                value="<?= htmlspecialchars($position) ?>"
                required>
        </div>


        <div class="mb-3">
            <label class="form-label">Description</label>

            <textarea
                name="description"
                class="form-control"
                rows="4"><?= htmlspecialchars($description) ?></textarea>
        </div>


        <div class="mb-3">
            <label class="form-label">Image</label>

            <input
                type="file"
                name="image"
                class="form-control">
        </div>


        <div class="mb-3">
            <label class="form-label">Facebook</label>

            <input
                type="url"
                name="facebook"
                class="form-control"
                value="<?= htmlspecialchars($facebook) ?>">
        </div>


        <div class="mb-3">
            <label class="form-label">Instagram</label>

            <input
                type="url"
                name="instagram"
                class="form-control"
                value="<?= htmlspecialchars($instagram) ?>">
        </div>


        <div class="mb-3">
            <label class="form-label">LinkedIn</label>

            <input
                type="url"
                name="linkedin"
                class="form-control"
                value="<?= htmlspecialchars($linkedin) ?>">
        </div>


        <button
            type="submit"
            class="btn btn-primary">
            Add Member
        </button>

        <a
            href="index.php"
            class="btn btn-secondary">
            Back
        </a>

    </form>

</div>

<?php

include "../includes/footer.php";

?>