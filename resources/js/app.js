import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('auth-container');
    const btnSignUp = document.getElementById('go-to-signup');
    const btnSignIn = document.getElementById('go-to-signin');

    // Slide & Fade Transitions Toggle
    if (btnSignUp && container) {
        btnSignUp.addEventListener('click', () => {
            container.classList.add('active');
        });
    }

    if (btnSignIn && container) {
        btnSignIn.addEventListener('click', () => {
            container.classList.remove('active');
        });
    }

    // Universal Toggle Password Visibility
    const togglePasswordButtons = document.querySelectorAll('.toggle-password');
    togglePasswordButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            
            const relativeWrapper = button.closest('.relative');
            const passwordInput = relativeWrapper.querySelector('input');
            const eyeIconPath = button.querySelector('.eye-path');
            
            const svg = button.querySelector('svg');
            if (passwordInput && eyeIconPath) {
                // Trigger pop animation
                if (svg) {
                    svg.classList.add('eye-pop-active');
                    svg.addEventListener('animationend', () => {
                        svg.classList.remove('eye-pop-active');
                    }, { once: true });
                }

                const isPassword = passwordInput.getAttribute('type') === 'password';
                passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                
                if (isPassword) {
                    // Path for Eye Open
                    eyeIconPath.setAttribute('d', 'M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z');
                } else {
                    // Path for Eye Slash (Hidden)
                    eyeIconPath.setAttribute('d', 'M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.025 10.025 0 014.132-5.4M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 21l-2-2m-13.875-13.875L3 3');
                }
            }
        });
    });
});
