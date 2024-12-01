// Check login status on page load
  document.addEventListener('DOMContentLoaded', function () {
    const isLoggedIn = localStorage.getItem('isLoggedIn');
    const authButtons = document.getElementById('authButtons');
    const userIcon = document.getElementById('userIcon');
    const myPackageMenu = document.getElementById('myPackageMenu');
    const logoutBtn = document.getElementById('logoutBtn');

    if (isLoggedIn) {
      authButtons.style.display = 'none';
      userIcon.style.display = 'flex';
      myPackageMenu.style.display = 'block';
    } else {
      authButtons.style.display = 'flex';
      userIcon.style.display = 'none';
      myPackageMenu.style.display = 'none';
    }

    // Handle logout
    if (logoutBtn) {
      logoutBtn.addEventListener('click', function () {
        localStorage.removeItem('isLoggedIn');
        alert('Logged out successfully!');
        location.reload(); // Reload to reflect the change
      });
    }
  });

//   handle booking function

  function handleBooking(packageName, price, duration, description) {
    const isLoggedIn = localStorage.getItem('isLoggedIn');

    if (!isLoggedIn) {
        alert("Please log in first to book this package.");
        return;
    }

    // Store the booking details in localStorage
    const packageDetails = {
        packageName,
        price,
        duration,
        description
    };
    localStorage.setItem('packageDetails', JSON.stringify(packageDetails));

    // Redirect to myPackage.html to show the package details
    window.location.href = 'myPackage.html';
}
