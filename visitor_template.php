<?php
/**
 * Template by          : Tutorial SLiMS
 * Template description : Integrated library catalog search theme for SLiMS 9.8.0 (ID/EN)
 * Email                : tutorialslims@gmail.com
 * Instagram            : https://instagram.com/tutorial_slims (@tutorial_slims)
 * Copyright            : (c) Tutorial SLiMS. Licensed under GPLv3.
 * Template ini merupakan ide dari Hendro Wicaksono | Email : hendro.wicaksono@gmail.com
 */

/**
 * @Created by          : Waris Agung Widodo (ido.alit@gmail.com)
 * @Date                : 2020-01-03 08:49
 * @File name           : visitor_template.php (v3 — Enhanced Cinematic)
 */

$main_template_path = __DIR__ . '/login_template.inc.php';

// set default language
if (isset($_GET['select_lang'])) {
    $select_lang = trim(strip_tags($_GET['select_lang']));
    if (isset($_COOKIE['select_lang'])) {
        @setcookie('select_lang', $select_lang, [
            'expires' => time()-14400,
            'path' => SWB,
            'domain' => '',
            'secure' => false,
            'httponly' => true,
            'samesite' => 'Lax',
        ]);
    }
    @setcookie('select_lang', $select_lang, [
        'expires' => time()+14400,
        'path' => SWB,
        'domain' => '',
        'secure' => false,
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    $sysconf['default_lang'] = $select_lang;
} else if (isset($_COOKIE['select_lang'])) {
    $sysconf['default_lang'] = trim(strip_tags($_COOKIE['select_lang']));
}

?>
<!-- INLINE CSS: Visitor Counter Enhanced -->
<style>
/* ===== Visitor Counter v3 — Self-Contained Styles ===== */
.kdv-page {
    min-height: 100vh;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 20px;
    position: relative;
    overflow-x: hidden;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    transition: background 0.5s ease;
}

[data-theme="dark"] .kdv-page {
    background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
}

/* Animated Background Particles */
.kdv-particles {
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    pointer-events: none;
    overflow: hidden;
    z-index: 0;
}

.kdv-particle {
    position: absolute;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    animation: kdvFloat 20s infinite linear;
}

[data-theme="dark"] .kdv-particle {
    background: rgba(255, 255, 255, 0.05);
}

@keyframes kdvFloat {
    0% {
        transform: translateY(100vh) translateX(0) rotate(0deg);
        opacity: 0;
    }
    10% { opacity: 1; }
    90% { opacity: 1; }
    100% {
        transform: translateY(-100vh) translateX(100px) rotate(720deg);
        opacity: 0;
    }
}

/* Theme Toggle Button */
.kdv-theme-btn {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 1000;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    border: 2px solid rgba(255, 255, 255, 0.3);
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    color: #fff;
    font-size: 20px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.kdv-theme-btn:hover {
    transform: rotate(180deg) scale(1.1);
    background: rgba(255, 255, 255, 0.25);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
}

/* Main Container */
.kdv-container {
    position: relative;
    z-index: 1;
    width: 100%;
    max-width: 1200px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
    align-items: stretch;
}

@media (max-width: 900px) {
    .kdv-container {
        grid-template-columns: 1fr;
        max-width: 600px;
    }
}

/* Cards */
.kdv-card {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 24px;
    padding: 40px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
    animation: kdvSlideIn 0.6s ease-out;
}

[data-theme="dark"] .kdv-card {
    background: rgba(30, 30, 50, 0.95);
    border-color: rgba(255, 255, 255, 0.1);
}

@keyframes kdvSlideIn {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.kdv-card:nth-child(2) {
    animation-delay: 0.2s;
}

/* Brand Section */
.kdv-brand {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 25px;
    padding-bottom: 20px;
    border-bottom: 2px solid rgba(0, 0, 0, 0.1);
}

[data-theme="dark"] .kdv-brand {
    border-bottom-color: rgba(255, 255, 255, 0.1);
}

.kdv-brand img {
    height: 50px;
    width: auto;
    border-radius: 12px;
}

.kdv-brand-text strong {
    display: block;
    font-size: 20px;
    font-weight: 700;
    color: #1a1a2e;
}

[data-theme="dark"] .kdv-brand-text strong {
    color: #fff;
}

.kdv-brand-text span {
    font-size: 13px;
    color: #666;
}

[data-theme="dark"] .kdv-brand-text span {
    color: #aaa;
}

/* Chip Badge */
.kdv-chip {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
    color: #1a1a2e;
    font-size: 12px;
    font-weight: 700;
    padding: 8px 16px;
    border-radius: 999px;
    margin-bottom: 20px;
    box-shadow: 0 4px 15px rgba(251, 191, 36, 0.4);
    animation: kdvPulse 2s ease-in-out infinite;
}

@keyframes kdvPulse {
    0%, 100% {
        box-shadow: 0 4px 15px rgba(251, 191, 36, 0.4);
    }
    50% {
        box-shadow: 0 6px 20px rgba(251, 191, 36, 0.6);
    }
}

/* Title */
.kdv-title {
    font-size: 32px;
    font-weight: 800;
    color: #1a1a2e;
    margin: 0 0 10px 0;
    line-height: 1.2;
}

[data-theme="dark"] .kdv-title {
    color: #fff;
}

.kdv-title span {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.kdv-lead {
    font-size: 15px;
    color: #666;
    margin: 0 0 30px 0;
}

[data-theme="dark"] .kdv-lead {
    color: #aaa;
}

/* Form Fields */
.kdv-form label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: #333;
    margin-bottom: 8px;
}

[data-theme="dark"] .kdv-form label {
    color: #ddd;
}

.kdv-field {
    position: relative;
    margin-bottom: 20px;
}

.kdv-field i {
    position: absolute;
    left: 16px;
    top: 50%;
    transform: translateY(-50%);
    color: #667eea;
    font-size: 16px;
    pointer-events: none;
}

.kdv-field input {
    width: 100%;
    padding: 14px 16px 14px 48px;
    border: 2px solid rgba(102, 126, 234, 0.2);
    border-radius: 12px;
    font-size: 15px;
    background: rgba(255, 255, 255, 0.8);
    color: #1a1a2e;
    transition: all 0.3s ease;
    outline: none;
}

[data-theme="dark"] .kdv-field input {
    background: rgba(255, 255, 255, 0.05);
    border-color: rgba(102, 126, 234, 0.3);
    color: #fff;
}

.kdv-field input:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    background: rgba(255, 255, 255, 1);
}

[data-theme="dark"] .kdv-field input:focus {
    background: rgba(255, 255, 255, 0.1);
}

.kdv-field input::placeholder {
    color: #999;
}

[data-theme="dark"] .kdv-field input::placeholder {
    color: #777;
}

.kdv-hint {
    display: block;
    font-size: 12px;
    color: #888;
    margin: -10px 0 25px 0;
    font-style: italic;
}

[data-theme="dark"] .kdv-hint {
    color: #888;
}

/* Submit Button */
.kdv-submit {
    width: 100%;
    padding: 16px;
    border: none;
    border-radius: 12px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    transition: all 0.3s ease;
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
}

.kdv-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 30px rgba(102, 126, 234, 0.5);
}

.kdv-submit:active {
    transform: translateY(0);
}

/* Powered By */
.kdv-powered {
    text-align: center;
    margin-top: 25px;
    padding-top: 20px;
    border-top: 1px solid rgba(0, 0, 0, 0.1);
    font-size: 12px;
    color: #888;
}

[data-theme="dark"] .kdv-powered {
    border-top-color: rgba(255, 255, 255, 0.1);
    color: #777;
}

.kdv-powered code {
    background: rgba(102, 126, 234, 0.15);
    color: #667eea;
    padding: 2px 8px;
    border-radius: 4px;
    font-weight: 600;
}

/* Side Card - Quote Section */
.kdv-side-card {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    background: linear-gradient(135deg, rgba(255,255,255,0.95) 0%, rgba(248,250,252,0.95) 100%);
}

[data-theme="dark"] .kdv-side-card {
    background: linear-gradient(135deg, rgba(30,30,50,0.95) 0%, rgba(26,26,46,0.95) 100%);
}

/* Result Display */
.kdv-result {
    width: 100%;
    animation: kdvFadeIn 0.5s ease;
}

@keyframes kdvFadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.kdv-avatar {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    margin: 0 auto 20px;
    border: 4px solid #667eea;
    padding: 4px;
    background: #fff;
    box-shadow: 0 8px 30px rgba(102, 126, 234, 0.3);
}

.kdv-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
}

.kdv-message {
    font-size: 20px;
    font-weight: 700;
    color: #1a1a2e;
    margin: 0;
    line-height: 1.4;
}

[data-theme="dark"] .kdv-message {
    color: #fff;
}

/* Quote Block */
.kdv-quote {
    margin: 0;
    padding: 0;
}

.kdv-quote i {
    font-size: 48px;
    color: #667eea;
    opacity: 0.3;
    margin-bottom: 20px;
}

.kdv-quote p {
    font-size: 18px;
    font-style: italic;
    color: #333;
    line-height: 1.6;
    margin: 0 0 15px 0;
}

[data-theme="dark"] .kdv-quote p {
    color: #ddd;
}

.kdv-quote footer {
    font-size: 14px;
    font-weight: 600;
    color: #667eea;
}

.kdv-quote footer::before {
    content: "— ";
}

/* Responsive */
@media (max-width: 600px) {
    .kdv-card {
        padding: 30px 20px;
    }
    
    .kdv-title {
        font-size: 24px;
    }
    
    .kdv-theme-btn {
        width: 45px;
        height: 45px;
        top: 15px;
        right: 15px;
    }
}
</style>

<!-- Main Page Container -->
<div class="kdv-page" id="visitor-counter">
    <!-- Animated Background Particles -->
    <div class="kdv-particles" id="kdv-particles"></div>
    
    <!-- Theme Toggle Button -->
    <button type="button" class="kdv-theme-btn" id="kdv-theme-toggle" aria-label="<?= __('Toggle theme') ?>" title="<?= __('Toggle theme') ?>">
        <i class="fas fa-moon"></i>
    </button>
    
    <div class="kdv-container">
        <!-- Form Card -->
        <div class="kdv-card kdv-form-card">
            <div class="kdv-brand">
                <?php
                $kdvImagesDisk = \SLiMS\Filesystems\Storage::images();
                if (isset($sysconf['logo_image']) && $sysconf['logo_image'] != '' && $kdvImagesDisk->isExists($path = 'default/' . $sysconf['logo_image'])) {
                    echo '<img src="' . SWB . 'lib/minigalnano/createthumb.php?filename=images/' . $path . '&width=350" alt="logo">';
                }
                ?>
                <div class="kdv-brand-text">
                    <strong><?= htmlspecialchars($sysconf['library_name']); ?></strong>
                    <?php if (!empty($sysconf['library_subname'])): ?>
                        <span><?= htmlspecialchars($sysconf['library_subname']); ?></span>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="kdv-chip">
                <i class="fas fa-door-open"></i> <?= __('Visitor Counter') ?>
            </div>
            
            <h1 class="kdv-title"><?= __('Welcome to ') ?><span><?= htmlspecialchars($sysconf['library_name']); ?></span></h1>
            <p class="kdv-lead"><?= __('Please fill your member ID or name.') ?></p>
            
            <form class="kdv-form" @submit.prevent="onSubmit">
                <label for="kdv-member"><?= __('Member ID') ?></label>
                <div class="kdv-field">
                    <i class="fas fa-id-card"></i>
                    <input v-model="memberId" ref="memberId" autofocus autocomplete="off" type="text" id="kdv-member"
                           placeholder="<?= __('Enter your member ID') ?>">
                </div>
                
                <label for="kdv-institution"><?= __('Institution') ?></label>
                <div class="kdv-field">
                    <i class="fas fa-building"></i>
                    <input v-model="institution" autocomplete="off" type="text" id="kdv-institution"
                           placeholder="<?= __('Enter your institution') ?>">
                </div>
                
                <small class="kdv-hint"><?= __('Enough fill your member ID if you are member of ') . htmlspecialchars($sysconf['library_name']); ?></small>
                
                <button type="submit" class="kdv-submit">
                    <i class="fas fa-check-circle"></i> <?= __('Check In') ?>
                </button>
            </form>
            
            <div class="kdv-powered">
                <?= __('Powered by ') ?> <code>SLiMS</code> &middot; YL
            </div>
        </div>
        
        <!-- Quote/Result Card -->
        <div class="kdv-card kdv-side-card">
            <div v-show="textInfo !== ''" class="kdv-result">
                <div class="kdv-avatar">
                    <img :src="image" alt="image" @error="onImageError">
                </div>
                <h3 class="kdv-message" v-html="textInfo"></h3>
            </div>
            
            <blockquote class="kdv-quote" v-show="textInfo === ''">
                <i class="fas fa-quote-left"></i>
                <p>{{quotes.content}}</p>
                <footer>{{quotes.author}}</footer>
            </blockquote>
        </div>
    </div>
</div>

<!-- INLINE JavaScript -->
<script src="<?php echo $sysconf['template']['dir'].'/'.$sysconf['template']['theme'].'/assets/js/axios.min.js'; ?>"></script>
<script src="<?= JWB . 'he.js' ?>"></script>
<script>
// ===== Visitor Counter Vue App =====
new Vue({
    el: '#visitor-counter',
    data() {
        return {
            memberId: '',
            institution: '',
            textInfo: '',
            image: './images/persons/photo.png',
            quotes: {},
            timeout: null,
            csrfName: '<?= \Volnix\CSRF\CSRF::getTokenName() ?>',
            csrfToken: '<?= \Volnix\CSRF\CSRF::getToken() ?>'
        }
    },
    mounted() {
        this.$refs.memberId.focus();
        this.getQuotes();
        this.createParticles();
        this.initThemeToggle();
    },
    methods: {
        createParticles() {
            const container = document.getElementById('kdv-particles');
            const particleCount = 15;
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'kdv-particle';
                
                const size = Math.random() * 10 + 5;
                particle.style.width = size + 'px';
                particle.style.height = size + 'px';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 20 + 's';
                particle.style.animationDuration = (Math.random() * 10 + 15) + 's';
                
                container.appendChild(particle);
            }
        },
        
        initThemeToggle() {
            const btn = document.getElementById('kdv-theme-toggle');
            const root = document.documentElement;
            const icon = btn.querySelector('i');
            
            // Load saved theme
            const savedTheme = localStorage.getItem('kd-theme') || 'light';
            root.setAttribute('data-theme', savedTheme);
            this.updateThemeIcon(icon, savedTheme);
            
            // Toggle theme on click
            btn.addEventListener('click', () => {
                const currentTheme = root.getAttribute('data-theme');
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                
                root.setAttribute('data-theme', newTheme);
                localStorage.setItem('kd-theme', newTheme);
                this.updateThemeIcon(icon, newTheme);
            });
        },
        
        updateThemeIcon(icon, theme) {
            icon.className = theme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
        },
        
        onImageError() {
            this.image = './images/persons/photo.png';
        },
        
        getQuotes() {
            axios.get('https://slims.web.id/kutipan/')
                .then(res => {
                    res.data.content = he.decode(res.data.content);
                    this.quotes = res.data;
                })
                .catch(() => {
                    this.quotes = {
                        content: "Kesengsaraan menghasilkan ketekunan. Ketekunan menghasilkan watak, dan watak menghasilkan harapan.",
                        author: "Pepatah Roma"
                    };
                })
                .finally(() => {
                    this.textInfo = '';
                });
        },
        
        onSubmit() {
            if (this.memberId === '') {
                this.resetForm();
                return;
            }
            
            let url = 'index.php?p=visitor<?= trim(isset($_GET['room']) ? '&room=' . simbio_security::xssFree($_GET['room']) : '') ?>';
            let data = new FormData();
            data.append('memberID', this.memberId);
            data.append('institution', this.institution);
            data.append('counter', 1);
            data.append(this.csrfName, this.csrfToken);
            
            axios({
                url: url,
                method: 'post',
                data: data,
                headers: {'Content-Type': 'multipart/form-data', 'X-Response-With': 'application/json'}
            })
            .then(res => {
                this.textInfo = res.data.message;
                this.image = `./images/persons/${res.data.image}`;
                if (res.data.new_token) {
                    this.csrfToken = res.data.new_token;
                }
                <?php if ($sysconf['template']['visitor_log_voice']) : ?>
                this.textToSpeech(this.textInfo.replace(/(<([^>]+)>)/ig, ''));
                <?php endif; ?>
            })
            .catch(err => {
                console.log(err);
                if (err.response && err.response.data.new_token) {
                    this.csrfToken = err.response.data.new_token;
                }
            })
            .finally(() => {
                this.resetForm();
                clearTimeout(this.timeout);
                this.timeout = setTimeout(() => {
                    this.getQuotes();
                }, 5000);
            });
        },
        
        resetForm() {
            this.memberId = '';
            this.institution = '';
            this.$refs.memberId.focus();
        },
        
        textToSpeech(message) {
            const utterance = new SpeechSynthesisUtterance(message);
            utterance.volume = 1;
            utterance.rate = 1;
            utterance.pitch = 1;
            utterance.lang = '<?php echo str_replace('_', '-', $sysconf['default_lang']); ?>';
            speechSynthesis.cancel();
            speechSynthesis.speak(utterance);
        }
    }
});
</script>