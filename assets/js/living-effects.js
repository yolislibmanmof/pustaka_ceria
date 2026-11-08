/**
 * Living Effects Initialization for Pustaka Ceria (Enhanced International Edition)
 * Safe, non-blocking, and SLiMS-compatible
 */
document.addEventListener("DOMContentLoaded", function() {
    
    // 1. Hilangkan Preloader dengan halus
    const preloader = document.getElementById('kd-preloader');
    if (preloader) {
        window.addEventListener('load', () => {
            preloader.classList.add('fade-out');
            setTimeout(() => preloader.remove(), 500);
        });
    }

    // 2. Inisialisasi Particles Network di Hero Section (Enhanced - MORE VISIBLE)
    if (typeof tsParticles !== 'undefined' && document.getElementById('tsparticles-hero')) {
        tsParticles.load("tsparticles-hero", {
            fpsLimit: 60,
            fullScreen: { enable: false },
            particles: {
                number: { 
                    value: 90, // Lebih banyak partikel (dari 70)
                    density: { enable: true, value_area: 800 } 
                },
                color: { value: ["#60a5fa", "#a78bfa", "#fbbf24", "#34d399", "#f87171"] }, // Tambah warna merah
                shape: { type: "circle" },
                opacity: { 
                    value: 0.6, // Lebih terang (dari 0.4)
                    random: true,
                    anim: { enable: true, speed: 1.5, opacity_min: 0.2, sync: false } // Animasi lebih cepat
                },
                size: { 
                    value: 4, // Lebih besar (dari 3)
                    random: true,
                    anim: { enable: true, speed: 2.5, size_min: 0.8, sync: false }
                },
                line_linked: {
                    enable: true,
                    distance: 160, // Jarak lebih jauh (dari 140)
                    color: "#60a5fa",
                    opacity: 0.35, // Garis lebih terang (dari 0.2)
                    width: 1.5 // Garis lebih tebal (dari 1)
                },
                move: { 
                    enable: true, 
                    speed: 0.9, // Gerakan lebih cepat (dari 0.7)
                    direction: "none", 
                    random: true, 
                    straight: false,
                    out_mode: "out", 
                    bounce: false,
                    attract: { enable: true, rotateX: 600, rotateY: 1200 }
                }
            },
            interactivity: {
                detect_on: "canvas",
                events: { 
                    onHover: { enable: true, mode: "grab" },
                    onClick: { enable: true, mode: "push" },
                    resize: true
                },
                modes: { 
                    grab: { distance: 180, line_linked: { opacity: 0.6 } }, // Lebih responsif
                    push: { particles_nb: 5 } // Tambah lebih banyak partikel saat klik
                }
            },
            retina_detect: true
        });
    }

    // 3. Inisialisasi 3D Tilt pada Kartu Buku
    if (typeof VanillaTilt !== 'undefined') {
        VanillaTilt.init(document.querySelectorAll(".kd-tilt-card"), {
            max: 6,
            speed: 400,
            glare: true,
            "max-glare": 0.15,
            scale: 1.02,
            "gyroscope": false // Dinonaktifkan untuk performa mobile yang lebih stabil
        });
    }

    // 4. Auto Slider untuk Background Images (SMOOTHER TRANSITION)
    const heroSection = document.querySelector('.kd-hero-pro[data-slides]');
    if (heroSection) {
        try {
            const slides = JSON.parse(heroSection.getAttribute('data-slides'));
            
            if (slides && slides.length > 1) {
                let currentSlide = 0;
                
                function nextSlide() {
                    currentSlide = (currentSlide + 1) % slides.length;
                    
                    // Smooth cross-fade effect
                    heroSection.style.transition = 'opacity 1.2s cubic-bezier(0.4, 0, 0.2, 1)'; // Lebih smooth
                    heroSection.style.opacity = '0.6'; // Fade lebih dalam
                    
                    setTimeout(() => {
                        heroSection.style.backgroundImage = `url('${slides[currentSlide]}')`;
                        // Tambahkan efek zoom subtle
                        heroSection.style.transform = 'scale(1.02)';
                        
                        setTimeout(() => {
                            heroSection.style.opacity = '1';
                            heroSection.style.transform = 'scale(1)';
                        }, 100);
                    }, 600);
                }
                
                // Ganti slide setiap 6 detik (lebih lama untuk apresiasi visual)
                setInterval(nextSlide, 6000);
            }
        } catch (e) {
            console.log('Slider data parsing error:', e);
        }
    }
});