document.addEventListener('DOMContentLoaded', () => {
    console.log('OJJ Portfolio Loaded');
    
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });

    // Form submission handler (Placeholder)
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            const btn = form.querySelector('button');
            const originalText = btn.innerText;
            
            btn.innerText = 'SENDING...';
            btn.disabled = true;
            
            // Simulate sending
            setTimeout(() => {
                alert('Thank you! Your message has been sent.');
                form.reset();
                btn.innerText = originalText;
                btn.disabled = false;
            }, 1000);
        });
    }
});
