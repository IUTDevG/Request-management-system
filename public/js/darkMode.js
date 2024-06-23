function themeSwitcher() {
    return {
        theme: localStorage.getItem('theme') || 'system',
        systemPrefersDark: window.matchMedia('(prefers-color-scheme: dark)').matches,
        init() {
            this.applyTheme();
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
                this.systemPrefersDark = e.matches;
                if (this.theme === 'system') {
                    this.applyTheme();
                }
            });
        },
        setTheme(theme) {
            this.theme = theme;
            localStorage.setItem('theme', theme);
            this.applyTheme();
        },
        applyTheme() {
            if (this.theme === 'light') {
                document.documentElement.classList.remove('dark');
            } else if (this.theme === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                if (this.systemPrefersDark) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            }
        },
        get themeClass() {
            return this.theme === 'dark' || (this.theme === 'system' && this.systemPrefersDark) ? 'dark' : '';
        }
    }
}
