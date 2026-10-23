/* Portofolio Keyra Oktaviani — JavaScript biasa (tanpa library) */
(function () {
    'use strict';
    var reduceMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var $ = function (s, r) { return (r || document).querySelector(s); };
    var $$ = function (s, r) { return Array.prototype.slice.call((r || document).querySelectorAll(s)); };

    /* ---------- Navbar: efek scroll, menu mobile, link aktif ---------- */
    var nav = $('[data-nav]');
    if (nav) {
        var onScroll = function () { nav.classList.toggle('is-scrolled', window.scrollY > 8); };
        onScroll();
        window.addEventListener('scroll', onScroll, { passive: true });

        var toggle = $('[data-menu-toggle]', nav);
        var menu = $('[data-mobile-menu]', nav);
        var setMenu = function (open) {
            if (!toggle || !menu) return;
            menu.classList.toggle('is-open', open);
            toggle.setAttribute('aria-expanded', String(open));
            var o = $('[data-icon-open]', toggle), c = $('[data-icon-close]', toggle);
            if (o) o.hidden = open;
            if (c) c.hidden = !open;
        };
        if (toggle) toggle.addEventListener('click', function () { setMenu(!menu.classList.contains('is-open')); });
        if (menu) $$('a', menu).forEach(function (a) { a.addEventListener('click', function () { setMenu(false); }); });
        document.addEventListener('keydown', function (e) { if (e.key === 'Escape') setMenu(false); });

        var sections = $$('[data-section]');
        var links = $$('[data-nav-link]');
        if (sections.length && 'IntersectionObserver' in window) {
            var setActive = function (id) { links.forEach(function (l) { l.classList.toggle('is-active', l.dataset.navLink === id); }); };
            var spy = new IntersectionObserver(function (entries) {
                entries.forEach(function (en) { if (en.isIntersecting) setActive(en.target.dataset.section); });
            }, { rootMargin: '-45% 0px -50% 0px' });
            sections.forEach(function (s) { spy.observe(s); });
            setActive('beranda');
        }
    }

    /* ---------- Muncul saat di-scroll ---------- */
    var reveals = $$('.reveal');
    if (reveals.length) {
        if (reduceMotion || !('IntersectionObserver' in window)) {
            reveals.forEach(function (el) { el.classList.add('is-visible'); });
        } else {
            var io = new IntersectionObserver(function (entries) {
                entries.forEach(function (en) {
                    if (en.isIntersecting) { en.target.classList.add('is-visible'); io.unobserve(en.target); }
                });
            }, { threshold: 0.12, rootMargin: '0px 0px -6% 0px' });
            reveals.forEach(function (el) { io.observe(el); });
        }
    }

    /* ---------- Mode terang / gelap ---------- */
    var themeBtn = $('[data-theme-toggle]');
    if (themeBtn) {
        var root = document.documentElement;
        var sync = function () { themeBtn.setAttribute('aria-pressed', String(root.dataset.theme === 'dark')); };
        sync();
        themeBtn.addEventListener('click', function () {
            var next = root.dataset.theme === 'dark' ? 'light' : 'dark';
            root.dataset.theme = next;
            try { localStorage.setItem('theme', next); } catch (e) { /* penyimpanan dinonaktifkan */ }
            sync();
        });
    }

    /* ---------- Filter proyek di beranda ---------- */
    var grid = $('[data-grid]');
    if (grid) {
        var fbtn = $$('[data-filter]');
        fbtn.forEach(function (b) {
            b.addEventListener('click', function () {
                var f = b.dataset.filter;
                fbtn.forEach(function (x) { x.classList.toggle('is-active', x === b); });
                $$('.pcard', grid).forEach(function (c) {
                    c.hidden = !(f === 'semua' || c.dataset.jenis === f);
                });
            });
        });
    }

    /* ---------- Toast ---------- */
    var dismiss = function (t) { t.classList.add('is-leaving'); setTimeout(function () { t.remove(); }, 320); };
    $$('[data-toast]').forEach(function (t) {
        var c = $('[data-toast-close]', t);
        if (c) c.addEventListener('click', function () { dismiss(t); });
        setTimeout(function () { dismiss(t); }, t.classList.contains('toast--error') ? 8000 : 5000);
    });

    /* ---------- Konfirmasi sebelum menghapus ---------- */
    document.addEventListener('submit', function (e) {
        var msg = e.target.dataset && e.target.dataset.confirm;
        if (msg && !window.confirm(msg)) e.preventDefault();
    });

    /* ---------- Indikator loading saat form dikirim ---------- */
    document.addEventListener('submit', function (e) {
        var f = e.target;
        if (e.defaultPrevented || !f.matches || !f.matches('[data-loading-form]')) return;
        var b = $('button[type="submit"]', f);
        if (b) setTimeout(function () { b.classList.add('is-loading'); }, 0);
    });
    window.addEventListener('pageshow', function () { $$('.btn.is-loading').forEach(function (b) { b.classList.remove('is-loading'); }); });

    /* ---------- Sidebar admin (mobile) ---------- */
    var side = $('[data-admin-side]'), backdrop = $('[data-admin-backdrop]');
    if (side) {
        var setSide = function (o) { side.classList.toggle('is-open', o); if (backdrop) backdrop.classList.toggle('is-open', o); };
        var tg = $('[data-admin-toggle]');
        if (tg) tg.addEventListener('click', function () { setSide(!side.classList.contains('is-open')); });
        if (backdrop) backdrop.addEventListener('click', function () { setSide(false); });
        document.addEventListener('keydown', function (e) { if (e.key === 'Escape') setSide(false); });
    }
})();
