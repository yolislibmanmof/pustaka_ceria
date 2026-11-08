/**
 * Living Effects Initialization for Pustaka Ceria (Enhanced International Edition)
 * v3.0 — Minimalist Cinematic Edition
 * Partikel minimalis + aurora, scroll progress, back-to-top, navbar solid,
 * card spotlight, hero parallax, crossfade slider, typewriter, ticker, reveal.
 * Safe, non-blocking, and SLiMS-compatible
 */
document.addEventListener("DOMContentLoaded", function () {

    const reduceMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const heroSection = document.querySelector('.kd-hero-pro[data-slides]');

    // ===============================================================
    // 1. PRELOADER — hilangkan dengan halus
    // ===============================================================
    const preloader = document.getElementById('kd-preloader');
    if (preloader) {
        window.addEventListener('load', () => {
            preloader.classList.add('fade-out');
            setTimeout(() => preloader.remove(), 600);
        });
    }

    // ===============================================================
    // 2. HERO BUILDER — layer crossfade, overlay, aurora, spotlight
    // ===============================================================
    if (heroSection) {
        try {
            const slides = JSON.parse(heroSection.getAttribute('data-slides')) || [];

            // --- 2 layer background untuk crossfade + Ken Burns ---
            const layerA = document.createElement('div');
            const layerB = document.createElement('div');
            layerA.className = 'kd-hero-layer is-active';
            layerB.className = 'kd-hero-layer';
            heroSection.prepend(layerB);
            heroSection.prepend(layerA);

            // --- Overlay gelap sinematik ---
            const overlay = document.createElement('div');
            overlay.className = 'kd-hero-overlay';
            const container = heroSection.querySelector('.kd-container');
            container ? heroSection.insertBefore(overlay, container) : heroSection.appendChild(overlay);

            // --- Aurora ambient glow (efek baru) ---
            const aurora = document.createElement('div');
            aurora.className = 'kd-aurora';
            aurora.innerHTML = '<span></span><span></span><span></span>';
            overlay.parentNode.insertBefore(aurora, overlay.nextSibling);

            // --- Cursor spotlight ---
            const spot = document.createElement('div');
            spot.className = 'kd-hero-spotlight';
            heroSection.appendChild(spot);

            if (slides.length) {
                layerA.style.backgroundImage = `url('${slides[0]}')`;
                heroSection.style.backgroundImage = 'none';
            }

            // --- Crossfade slider setiap 7 detik ---
            if (slides.length > 1 && !reduceMotion) {
                let current = 0;
                let front = layerA, back = layerB;
                setInterval(() => {
                    current = (current + 1) % slides.length;
                    back.style.backgroundImage = `url('${slides[current]}')`;
                    void back.offsetWidth;
                    back.classList.add('is-active');
                    front.classList.remove('is-active');
                    [front, back] = [back, front];
                }, 7000);
            }

            // --- Spotlight + parallax ikon mengambang ---
            if (!reduceMotion) {
                const icons = heroSection.querySelectorAll('.hero-floating-icons i');
                let raf = null;
                heroSection.addEventListener('mousemove', (e) => {
                    if (raf) return;
                    raf = requestAnimationFrame(() => {
                        const r = heroSection.getBoundingClientRect();
                        const x = ((e.clientX - r.left) / r.width) * 100;
                        const y = ((e.clientY - r.top) / r.height) * 100;
                        spot.style.opacity = '1';
                        spot.style.background =
                            `radial-gradient(380px circle at ${x}% ${y}%, rgba(96,165,250,.14), rgba(167,139,250,.07) 45%, transparent 70%)`;
                        icons.forEach((ic, i) => {
                            const d = (i + 1) * 8;
                            ic.style.translate = `${(x - 50) / d}px ${(y - 50) / d}px`;
                        });
                        raf = null;
                    });
                });
                heroSection.addEventListener('mouseleave', () => { spot.style.opacity = '0'; });
            }
        } catch (e) {
            console.log('Hero builder error:', e);
        }
    }

    // ===============================================================
    // 3. TYPEWRITER — kata berjalan pada judul gradient
    // ===============================================================
    (function () {
        const word = document.querySelector('.hero-main-title .text-gradient');
        if (!word) return;

        const caret = document.createElement('span');
        caret.className = 'kd-type-caret';
        word.parentNode.insertBefore(caret, word.nextSibling);
        if (reduceMotion) return;

        const isID = /id_ID/i.test(location.search) || (document.documentElement.lang || '').indexOf('id') === 0;
        const extras = isID
            ? ['Sains', 'Inspirasi', 'Penemuan', 'Literasi', 'Sejarah']
            : ['Science', 'Inspiration', 'Discovery', 'Literacy', 'History'];
        const words = [word.textContent.trim()].concat(extras);

        let wi = 0, ci = words[0].length, deleting = true;

        function tick() {
            const w = words[wi];
            if (!deleting) {
                ci++;
                word.textContent = w.slice(0, ci);
                if (ci === w.length) { deleting = true; return setTimeout(tick, 2400); }
                return setTimeout(tick, 85 + Math.random() * 60);
            } else {
                ci--;
                word.textContent = w.slice(0, ci);
                if (ci === 0) { deleting = false; wi = (wi + 1) % words.length; return setTimeout(tick, 350); }
                return setTimeout(tick, 40);
            }
        }
        setTimeout(tick, 2600);
    })();

    // ===============================================================
    // 4. TICKER — marquee berjalan di dasar hero
    // ===============================================================
    (function () {
        const hero = document.querySelector('.kd-hero-pro');
        if (!hero) return;

        let items = [];
        document.querySelectorAll('.kd-topic').forEach((a) => {
            const t = a.textContent.replace(/[0-9]/g, '').trim();
            if (t) items.push(t);
        });
        if (!items.length) {
            items = ['Universal Library & Knowledge Center', 'Membaca \u2022 Belajar \u2022 Bertumbuh', 'Explore \u2022 Discover \u2022 Inspire'];
        }
        items = items.slice(0, 14);

        const bar = document.createElement('div');
        bar.className = 'kd-hero-ticker';
        const track = document.createElement('div');
        track.className = 'kd-ticker-track';

        items.concat(items).forEach((t) => {
            const s = document.createElement('span');
            s.className = 'kd-ticker-item';
            const i = document.createElement('i');
            i.className = 'fas fa-star';
            s.appendChild(i);
            s.appendChild(document.createTextNode(t));
            track.appendChild(s);
        });

        bar.appendChild(track);
        hero.appendChild(bar);
    })();

    // ===============================================================
    // 5. PARTICLES — MINIMALIS tapi tetap kentara
    //    Sedikit partikel kecil, garis tipis, twinkle halus.
    // ===============================================================
    if (typeof tsParticles !== 'undefined' && document.getElementById('tsparticles-hero')) {
        tsParticles.load("tsparticles-hero", {
            fpsLimit: 60,
            fullScreen: { enable: false },
            particles: {
                number: {
                    value: 40, // minimalis (dari 130)
                    density: { enable: true, value_area: 900 }
                },
                color: { value: ["#93c5fd", "#e2e8f0", "#fbbf24"] }, // palet tenang
                shape: { type: "circle" },
                opacity: {
                    value: 0.5,
                    random: true,
                    anim: { enable: true, speed: 0.8, opacity_min: 0.15, sync: false }
                },
                size: {
                    value: 2.4, // titik kecil elegan
                    random: true,
                    anim: { enable: true, speed: 1.2, size_min: 0.6, sync: false }
                },
                line_linked: {
                    enable: true,
                    distance: 140,
                    color: "#60a5fa",
                    opacity: 0.22, // garis tipis halus
                    width: 1
                },
                twinkle: {
                    particles: { enable: true, frequency: 0.05, opacity: 0.9, color: "#ffffff" }
                },
                move: {
                    enable: true,
                    speed: 0.6, // drift pelan
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
                    grab: { distance: 150, line_linked: { opacity: 0.45 } },
                    push: { particles_nb: 3 }
                }
            },
            retina_detect: true
        });
    }

    // ===============================================================
    // 6. TILT 3D + CARD SPOTLIGHT (glow mengikuti kursor pada kartu)
    // ===============================================================
    if (typeof VanillaTilt !== 'undefined') {
        VanillaTilt.init(document.querySelectorAll(".kd-tilt-card"), {
            max: 6,
            speed: 400,
            glare: true,
            "max-glare": 0.15,
            scale: 1.02,
            "gyroscope": false
        });
    }
    document.querySelectorAll('.kd-tilt-card').forEach((card) => {
        card.addEventListener('mousemove', (e) => {
            const r = card.getBoundingClientRect();
            card.style.setProperty('--mx', ((e.clientX - r.left) / r.width * 100) + '%');
            card.style.setProperty('--my', ((e.clientY - r.top) / r.height * 100) + '%');
        });
    });

    // ===============================================================
    // 7. SCROLL REVEAL — elemen muncul halus + underline menggambar
    // ===============================================================
    (function () {
        if (reduceMotion || !('IntersectionObserver' in window)) return;
        const targets = document.querySelectorAll(
            '.kd-section, .kd-ddc-card, .kd-ddc-pills, .kd-pop-head, .kd-pop-item, .kd-cat, .kd-topic'
        );
        const io = new IntersectionObserver((entries) => {
            entries.forEach((en) => {
                if (en.isIntersecting) { en.target.classList.add('kd-in'); io.unobserve(en.target); }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

        targets.forEach((el, i) => {
            el.classList.add('kd-reveal');
            el.style.transitionDelay = ((i % 6) * 70) + 'ms';
            io.observe(el);
        });
    })();

    // ===============================================================
    // 8. SCROLL ORCHESTRATOR — progress bar, navbar solid, back-to-top,
    //    dan hero parallax (satu listener, satu rAF: hemat performa)
    // ===============================================================
    (function () {
        // progress bar
        const progress = document.createElement('div');
        progress.className = 'kd-scroll-progress';
        document.body.appendChild(progress);

        // tombol kembali ke atas
        const backTop = document.createElement('button');
        backTop.className = 'kd-back-top';
        backTop.setAttribute('aria-label', 'Back to top');
        backTop.innerHTML = '<i class="fas fa-arrow-up"></i>';
        document.body.appendChild(backTop);
        backTop.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: reduceMotion ? 'auto' : 'smooth' });
        });

        const header = document.querySelector('.c-header');
        const heroInner = heroSection ? heroSection.querySelector('.kd-container') : null;
        let ticking = false;

        function onScroll() {
            const y = window.scrollY || document.documentElement.scrollTop;
            const max = document.documentElement.scrollHeight - window.innerHeight;

            progress.style.width = (max > 0 ? (y / max) * 100 : 0) + '%';
            if (header) header.classList.toggle('is-scrolled', y > 40);
            backTop.classList.toggle('show', y > 480);

            if (heroInner && !reduceMotion && y < window.innerHeight) {
                heroInner.style.transform = 'translateY(' + (y * 0.12).toFixed(1) + 'px)';
                heroInner.style.opacity = Math.max(1 - y / 700, 0).toFixed(2);
            }
            ticking = false;
        }

        window.addEventListener('scroll', () => {
            if (!ticking) { ticking = true; requestAnimationFrame(onScroll); }
        }, { passive: true });
        onScroll();
    })();
});