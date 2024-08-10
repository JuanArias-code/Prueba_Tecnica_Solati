<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="views/css/style.css">
    <title>Technical Test - API Form</title>
</head>
<body>
    <header>
        <h1>Technical Test Solati</h1>
        <p>API Form</p>
    </header>

    <main>
        <section class="form-section">
            <h2>Add Club Member User</h2>
            <form id="addUserForm">
                <div class="form-group">
                    <label for="name">first Name:</label>
                    <input type="text" id="first_name" name="first_name" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" id="last_name" name="last_name" required>
                </div>
                <div class="form-group">
                    <label for="contact_email">Contact Email:</label>
                    <input type="email" id="contact_email" name="contact_email" required>
                </div>
                <div class="form-group">
                    <label for="membership_type">Membership Type:</label>
                    <input type="text" id="membership_type" name="membership_type" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                    <span id="passwordError" class="error-message"></span> <!-- Mensaje de error -->

                </div>
                <button type="submit">Add User</button>
            </form>
        </section>

        <section class="form-section">
            <h2>Update Club Member User</h2>
            <form id="updateUserForm">
                <div class="form-group">
                    <label for="updateId">ID Member:</label>
                    <input type="number" id="updateId" name="id" required>
                </div>
                <div class="form-group">
                    <label for="updatefirst_name">First Name:</label>
                    <input type="text" id="updateFirst_name" name="first_name">
                </div>
                <div class="form-group">
                    <label for="updateLast_name">Last Name:</label>
                    <input type="text" id="updateLast_name" name="last_name">
                </div>
                <div class="form-group">
                    <label for="updateMembership_type">membership_type:</label>
                    <input type="text" id="updateMembership_type" name="membership_type">
                </div>
                <div class="form-group">
                    <label for="updateContact_email">Contact_email:</label>
                    <input type="email" id="updateContact_email" name="contact_email">
                </div>
                <div class="form-group">
                    <label for="updatePassword">Password:</label>
                    <input type="password" id="updatePassword" name="password">
                    <span id="passwordError" class="error-message"></span> <!-- Mensaje de error -->

                </div>
                <button type="submit">Update Member User</button>
            </form>
        </section>

        <section class="form-section">
            <h2>Delete Club Member User</h2>
            <form id="deleteUserForm">
                <div class="form-group">
                    <label for="deleteId">ID:</label>
                    <input type="number" id="deleteId" name="id" required>
                </div>
                <button type="submit">Delete Member User</button>
            </form>
        </section>

        <section class="form-section">
            <h2>Club Member Users List</h2>
            <div id="users"></div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Juan Arias. All rights reserved.</p>
    </footer>

    <script src="views/js/form_api.js"></script>
</body>
</html>
