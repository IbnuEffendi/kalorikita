import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
  // 1. Cek apakah ada 'tanda pengenal' di localStorage
  const isLoggedIn = localStorage.getItem('isLoggedIn');

  if (isLoggedIn === 'true') {
    // 2. Kalo ADA, kita ganti tombolnya
    
    // Versi Desktop
    const navGuestDesktop = document.getElementById('nav-guest-desktop');
    const navUserDesktop = document.getElementById('nav-user-desktop');
    if (navGuestDesktop) {
      navGuestDesktop.classList.add('hidden');
      navGuestDesktop.classList.remove('flex');
    }
    if (navUserDesktop) {
      navUserDesktop.classList.remove('hidden');
      navUserDesktop.classList.add('flex');
    }

    // Versi Mobile
    const navGuestMobile = document.getElementById('nav-guest-mobile');
    const navUserMobile = document.getElementById('nav-user-mobile');
    if (navGuestMobile) {
      navGuestMobile.classList.add('hidden');
      navGuestMobile.classList.remove('flex');
    }
    if (navUserMobile) {
      navUserMobile.classList.remove('hidden');
      navUserMobile.classList.add('flex');
    }
  }
});