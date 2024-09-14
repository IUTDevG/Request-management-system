import preset from '../../../../vendor/filament/filament/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/Admin/**/*.php',
        './resources/views/filament/admin/**/*.blade.php',
        './resources/views/vendor/filament-language-switch/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
}
