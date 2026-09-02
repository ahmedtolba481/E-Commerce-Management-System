<?php

include "../../config/database.php";

$error = "";

// Make sure id exists in URL
if (!isset($_GET["id"])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET["id"];



$query = mysqli_prepare(
    $conn,
    "SELECT * FROM team WHERE id = ?"
);

mysqli_stmt_bind_param($query, "i", $id);

mysqli_stmt_execute($query);

$result = mysqli_stmt_get_result($query);

$member = mysqli_fetch_assoc($result);



if (!$member) {
    header("Location: index.php");
    exit;
}


// Current data
$name = $member["name"];
$position = $member["position"];
$description = $member["description"];
$image = $member["image"];
$facebook = $member["facebook"];
$instagram = $member["instagram"];
$linkedin = $member["linkedin"];


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"]);
    $position = trim($_POST["position"]);
    $description = trim($_POST["description"]);
    $facebook = trim($_POST["facebook"]);
    $instagram = trim($_POST["instagram"]);
    $linkedin = trim($_POST["linkedin"]);


    // Validation
    if ($name == "" || $position == "") {

        $error = "Name and position are required.";

    } else {

        // Check if user selected a new image
        if (
            isset($_FILES["image"]) &&
            $_FILES["image"]["error"] == 0
        ) {

            // Delete old image
            if (!empty($image)) {

                $oldImagePath =
                    "../assets/images/team/" . $image;

                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }


            // Save new image
            $image =
                time() . "_" .
                basename($_FILES["image"]["name"]);

            $newImagePath =
                "../assets/images/team/" . $image;

            move_uploaded_file(
                $_FILES["image"]["tmp_name"],
                $newImagePath
            );
        }


        // Update database
        $update = mysqli_prepare(
            $conn,
            "UPDATE team
             SET
                name = ?,
                position = ?,
                description = ?,
                image = ?,
                facebook = ?,
                instagram = ?,
                linkedin = ?
             WHERE id = ?"
        );


        mysqli_stmt_bind_param(
            $update,
            "sssssssi",
            $name,
            $position,
            $description,
            $image,
            $facebook,
            $instagram,
            $linkedin,
            $id
        );


        mysqli_stmt_execute($update);


        header("Location: index.php");
        exit;
    }
}


include "../includes/header.php"; ?>
<link rel="stylesheet" href="../assets/css/team.css">
<?php
include "../includes/navbar.php";
include "../includes/sidebar.php";

?>


<div class="team-page">

    <h2 class="mb-4">
        Edit Team Member
    </h2>


    <?php if ($error != "") { ?>

        <div class="alert alert-danger">
            <?= $error ?>
        </div>

    <?php } ?>


    <form method="POST" enctype="multipart/form-data">


        <div class="mb-3">

            <label class="form-label">
                Name
            </label>

            <input
                type="text"
                name="name"
                class="form-control"
                value="<?= htmlspecialchars($name) ?>"
                required>

        </div>


        <div class="mb-3">

            <label class="form-label">
                Position
            </label>

            <input
                type="text"
                name="position"
                class="form-control"
                value="<?= htmlspecialchars($position) ?>"
                required>

        </div>


        <div class="mb-3">

            <label class="form-label">
                Description
            </label>

            <textarea
                name="description"
                class="form-control"
                rows="4"><?= htmlspecialchars($description) ?></textarea>

        </div>


        <?php if (!empty($image)) { ?>

            <div class="mb-3">

                <label class="form-label">
                    Current Image
                </label>

                <br>

                <img
                    src="../assets/images/team/<?= htmlspecialchars($image) ?>"
                    width="120"
                    height="120"
                    style="object-fit: cover; border-radius: 10px;">

            </div>

        <?php } ?>


        <div class="mb-3">

            <label class="form-label">
                Change Image
            </label>

            <input
                type="file"
                name="image"
                class="form-control">

        </div>


        <div class="mb-3">

            <label class="form-label">
                Facebook
            </label>

            <input
                type="url"
                name="facebook"
                class="form-control"
                value="<?= htmlspecialchars($facebook ?? "") ?>">

        </div>


        <div class="mb-3">

            <label class="form-label">
                Instagram
            </label>

            <input
                type="url"
                name="instagram"
                class="form-control"
                value="<?= htmlspecialchars($instagram ?? "") ?>">

        </div>


        <div class="mb-3">

            <label class="form-label">
                LinkedIn
            </label>

            <input
                type="url"
                name="linkedin"
                class="form-control"
                value="<?= htmlspecialchars($linkedin ?? "") ?>">

        </div>


        <button
            type="submit"
            class="btn btn-success">
            Update Member
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