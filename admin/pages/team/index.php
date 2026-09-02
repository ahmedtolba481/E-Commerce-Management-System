<?php

include "../../../config/database.php";

$query = "SELECT * FROM team ORDER BY id DESC";
$result = mysqli_query($conn, $query);

include "../../includes/header.php";

?>
<link rel="stylesheet" href="../../assets/css/team.css">
<?php 
include "../../includes/navbar.php";
include "../../includes/sidebar.php";
?>

<div class="team-page">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Team Members</h2>

        <a href="create.php" class="btn btn-primary">
            Add Team Member
        </a>
    </div>

    <table class="table table-bordered table-striped">

        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Position</th>
                <th>Description</th>
                <th>Facebook</th>
                <th>Instagram</th>
                <th>LinkedIn</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>

        <?php while ($member = mysqli_fetch_assoc($result)) { ?>

            <tr>

                <td>
                    <?= $member["id"] ?>
                </td>

                <td>
                <?php if (!empty($member["image"])) { ?>
        <img
            src="../../assets/images/team/<?= htmlspecialchars($member["image"]) ?>"
            width="70"
            height="70"
            style="object-fit: cover; border-radius: 8px;">
    <?php } else { ?>
        No Image
                    <?php } ?>
                </td>

                <td>
                    <?= htmlspecialchars($member["name"]) ?>
                </td>

                <td>
                    <?= htmlspecialchars($member["position"]) ?>
                </td>

                <td>
                    <?= htmlspecialchars($member["description"] ?? "") ?>
                </td>

                <td>
                    <?= htmlspecialchars($member["facebook"] ?? "") ?>
                </td>

                <td>
                    <?= htmlspecialchars($member["instagram"] ?? "") ?>
                </td>

                <td>
                    <?= htmlspecialchars($member["linkedin"] ?? "") ?>
                </td>

            <td>
    <div class="action-buttons">

        <a
            href="edit.php?id=<?= $member["id"] ?>"
            class="btn btn-primary btn-sm">
            Edit
        </a>

        <a
            href="delete.php?id=<?= $member["id"] ?>"
            class="btn btn-danger btn-sm"
            onclick="return confirm('Are you sure you want to delete this team member?')">
            Delete
        </a>

    </div>
</td>

            </tr>

        <?php } ?>

        </tbody>

    </table>

</div>

<?php

include "../../includes/footer.php";

?>