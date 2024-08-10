document.getElementById('addUserForm').addEventListener('submit', function(event) {
    const password = document.getElementById('password').value;
    const passwordError = document.getElementById('passwordError');

    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\W)(?=.*\d)[A-Za-z\d\W]{8,16}$/;

    if (!passwordRegex.test(password)) {
        event.preventDefault(); 
        passwordError.textContent = "La contraseña debe tener entre 8 y 16 caracteres, incluyendo al menos una letra minúscula, una letra mayúscula, un dígito y un símbolo.";
        passwordError.style.color = "red";
    } else {
        passwordError.textContent = ""; 
    }
});

async function handleFetch(url, options) {
    try {
        const response = await fetch(url, options);
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return await response.json();
    } catch (error) {
        console.error('Fetch error:', error);
        alert('Error de red. Por favor, inténtalo de nuevo.');
        return null;
    }
}

async function fetchUsers() {
    const data = await handleFetch('index.php?action=getUsers');
    if (data) {
        const usersDiv = document.getElementById('users');
        usersDiv.innerHTML = '';
        data.forEach(user => {
            const userElement = document.createElement('div');
            userElement.textContent = `Member ID: ${user.id}, Name: ${user.first_name}, Last Name: ${user.last_name}, Membership: ${user.membership_type}, Contact Email: ${user.contact_email}`;
            usersDiv.appendChild(userElement);
        });
    }
}

document.getElementById('addUserForm').addEventListener('submit', async function (event) {
    event.preventDefault();
    const first_name = document.getElementById('first_name').value.trim();
    const last_name = document.getElementById('last_name').value.trim();
    const contact_email = document.getElementById('contact_email').value.trim();
    const membership_type = document.getElementById('membership_type').value.trim();
    const password = document.getElementById('password').value;

    if (!first_name || !last_name || !contact_email || !membership_type || !password) {
        alert('Todos los campos son obligatorios.');
        return;
    }

    const data = await handleFetch('index.php?action=createUser', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            first_name,
            last_name,
            contact_email,
            membership_type,
            password
        })
    });

    if (data && data.success) {
        fetchUsers();
        document.getElementById('addUserForm').reset();
    } else if (data) {
        alert(data.error || 'Error al agregar el usuario');
    }
});

document.getElementById('updateUserForm').addEventListener('submit', async function (event) {
    event.preventDefault();
    const id = document.getElementById('updateId').value.trim();
    const first_name = document.getElementById('updateFirst_name').value.trim();
    const last_name = document.getElementById('updateLast_name').value.trim();
    const membership_type = document.getElementById('updateMembership_type').value.trim();
    const contact_email = document.getElementById('updateContact_email').value.trim();
    const password = document.getElementById('updatePassword').value;

    if (!id || !first_name || !last_name || !membership_type || !contact_email) {
        alert('Todos los campos excepto la contraseña son obligatorios.');
        return;
    }

    const data = await handleFetch('index.php?action=updateUser', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            id,
            first_name,
            last_name,
            membership_type,
            contact_email,
            password
        })
    });

    if (data && data.success) {
        fetchUsers();
        document.getElementById('updateUserForm').reset();
    } else if (data) {
        alert(data.error || 'Error al actualizar el usuario');
    }
});

document.getElementById('deleteUserForm').addEventListener('submit', async function (event) {
    event.preventDefault();
    const id = document.getElementById('deleteId').value.trim();

    if (!id) {
        alert('ID es obligatorio.');
        return;
    }

    const data = await handleFetch('index.php?action=deleteUser', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id })
    });

    if (data && data.deleted) {
        fetchUsers();
        document.getElementById('deleteUserForm').reset();
    } else if (data) {
        alert(data.error || 'Error al eliminar el usuario');
    }
});

document.addEventListener('DOMContentLoaded', fetchUsers);
