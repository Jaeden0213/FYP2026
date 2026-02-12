<x-layouts.game-side-bar title="Timer & Stopwatch">

    {{-- Page wrapper --}}
    <div class="min-h-screen flex items-center justify-center p-4 bg-gray-900">
        <div x-data="timerApp()" class="w-full max-w-2xl">
            <div class="bg-gray-800 rounded-3xl p-8 shadow-2xl">

                {{-- =========================
                    Tabs + Actions (Sound/FS)
                    ========================= --}}
                <div class="flex gap-4 mb-8 flex-wrap">

                    {{-- Timer Tab --}}
                    <button
                        @click="activeTab = 'timer'"
                        :class="activeTab === 'timer' ? 'bg-yellow-600' : 'bg-gray-700'"
                        class="flex items-center gap-2 px-6 py-3 rounded-full text-white font-medium transition-all hover:bg-yellow-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Timer
                    </button>

                    {{-- Stopwatch Tab --}}
                    <button
                        @click="activeTab = 'stopwatch'"
                        :class="activeTab === 'stopwatch' ? 'bg-yellow-600' : 'bg-gray-700'"
                        class="flex items-center gap-2 px-6 py-3 rounded-full text-white font-medium transition-all hover:bg-yellow-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" stroke-width="2"></circle>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 6v6l4 2"></path>
                        </svg>
                        Stopwatch
                    </button>

                    {{-- Right-side actions --}}
                    <div class="ml-auto flex gap-3">
                        {{-- Sound toggle --}}
                        <button @click="soundEnabled = !soundEnabled"
                                :class="soundEnabled ? 'text-yellow-500' : 'text-gray-500'"
                                class="hover:text-yellow-400 transition-colors"
                                :title="soundEnabled ? 'Sound On' : 'Sound Off'">
                            <svg x-show="soundEnabled" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77s-2.99-7.86-7-8.77z"></path>
                            </svg>
                            <svg x-show="!soundEnabled" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M16.5 12c0-1.77-1.02-3.29-2.5-4.03v2.21l2.45 2.45c.03-.2.05-.41.05-.63zm2.5 0c0 .94-.2 1.82-.54 2.64l1.51 1.51C20.63 14.91 21 13.5 21 12c0-4.28-2.99-7.86-7-8.77v2.06c2.89.86 5 3.54 5 6.71zM4.27 3L3 4.27 7.73 9H3v6h4l5 5v-6.73l4.25 4.25c-.67.52-1.42.93-2.25 1.18v2.06c1.38-.31 2.63-.95 3.69-1.81L19.73 21 21 19.73l-9-9L4.27 3zM12 4L9.91 6.09 12 8.18V4z"></path>
                            </svg>
                        </button>

                        {{-- Fullscreen --}}
                        <button @click="toggleFullscreen"
                                class="text-yellow-500 hover:text-yellow-400 transition-colors"
                                title="Fullscreen">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- =========================
                    TIMER VIEW
                    ========================= --}}
                <div x-show="activeTab === 'timer'" x-cloak class="space-y-8">
                    <div class="relative flex items-center justify-center">
                        <svg class="transform -rotate-90" width="400" height="400" viewBox="0 0 400 400">
                            <circle cx="200" cy="200" r="180" stroke="#374151" stroke-width="4" fill="none"></circle>
                            <circle
                                cx="200" cy="200" r="180"
                                :stroke="timeLeft <= 10 && timeLeft > 0 ? '#EF4444' : '#D97706'"
                                stroke-width="4" fill="none"
                                :stroke-dasharray="CIRC"
                                :stroke-dashoffset="CIRC - (CIRC * timerProgress / 100)"
                                stroke-linecap="round"
                                class="transition-all duration-300">
                            </circle>
                        </svg>

                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <div class="text-7xl md:text-8xl font-light text-white mb-6"
                                 :class="timeLeft <= 10 && timeLeft > 0 && isRunning ? 'animate-pulse text-red-500' : ''"
                                 x-text="formatTime(timeLeft)"></div>

                            {{-- Adjust time buttons only when not running --}}
                            <div class="flex gap-3 flex-wrap justify-center" x-show="!isRunning">
                                <button @click="adjustTime(-60)"
                                        class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-full transition-colors text-sm">
                                    -1:00
                                </button>
                                <button @click="adjustTime(-30)"
                                        class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-full transition-colors text-sm">
                                    -0:30
                                </button>
                                <button @click="adjustTime(30)"
                                        class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-full transition-colors text-sm">
                                    +0:30
                                </button>
                                <button @click="adjustTime(60)"
                                        class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-full transition-colors text-sm">
                                    +1:00
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Presets --}}
                    <div class="flex gap-2 flex-wrap justify-center" x-show="!isRunning">
                        <button @click="setTimer(5)" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg transition-colors text-sm">5 min</button>
                        <button @click="setTimer(10)" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg transition-colors text-sm">10 min</button>
                        <button @click="setTimer(15)" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg transition-colors text-sm">15 min</button>
                        <button @click="setTimer(25)" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg transition-colors text-sm">25 min</button>
                        <button @click="setTimer(30)" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg transition-colors text-sm">30 min</button>
                    </div>

                    {{-- Main buttons --}}
                    <div class="grid grid-cols-2 gap-4">
                        <button @click="toggleTimer"
                                :class="isRunning ? 'bg-red-600 hover:bg-red-500' : 'bg-green-600 hover:bg-green-500'"
                                class="py-5 text-white rounded-2xl font-medium text-lg transition-all flex items-center justify-center gap-2 shadow-lg">
                            <svg x-show="!isRunning" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z"></path>
                            </svg>
                            <svg x-show="isRunning" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M6 4h4v16H6V4zm8 0h4v16h-4V4z"></path>
                            </svg>
                            <span x-text="isRunning ? 'Pause' : 'Start'"></span>
                        </button>

                        <button @click="resetTimer"
                                class="py-5 bg-gray-700 hover:bg-gray-600 text-white rounded-2xl font-medium text-lg transition-all flex items-center justify-center gap-2 shadow-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Reset
                        </button>
                    </div>
                </div>

                {{-- =========================
                    STOPWATCH VIEW
                    ========================= --}}
                <div x-show="activeTab === 'stopwatch'" x-cloak class="space-y-8">
                    <div class="relative flex items-center justify-center">
                        <svg class="transform -rotate-90" width="400" height="400" viewBox="0 0 400 400">
                            <circle cx="200" cy="200" r="180" stroke="#374151" stroke-width="4" fill="none"></circle>
                            <circle
                                cx="200" cy="200" r="180"
                                stroke="#D97706" stroke-width="4" fill="none"
                                :stroke-dasharray="CIRC"
                                :stroke-dashoffset="CIRC - (CIRC * ((stopwatchTime % 60000) / 60000))"
                                stroke-linecap="round"
                                class="transition-all duration-100">
                            </circle>
                        </svg>

                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <div class="text-6xl md:text-7xl font-light text-white mb-4" x-text="formatStopwatch(stopwatchTime)"></div>
                            <div x-show="laps.length > 0" class="text-sm text-gray-400">
                                Lap <span x-text="laps.length"></span>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <button @click="toggleStopwatch"
                                :class="isStopwatchRunning ? 'bg-red-600 hover:bg-red-500' : 'bg-green-600 hover:bg-green-500'"
                                class="py-5 text-white rounded-2xl font-medium text-lg transition-all flex items-center justify-center gap-2 shadow-lg">
                            <svg x-show="!isStopwatchRunning" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z"></path>
                            </svg>
                            <svg x-show="isStopwatchRunning" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M6 4h4v16H6V4zm8 0h4v16h-4V4z"></path>
                            </svg>
                            <span x-text="isStopwatchRunning ? 'Pause' : 'Start'"></span>
                        </button>

                        <button @click="isStopwatchRunning ? addLap() : resetStopwatch()"
                                class="py-5 bg-gray-700 hover:bg-gray-600 text-white rounded-2xl font-medium text-lg transition-all flex items-center justify-center gap-2 shadow-lg">
                            <svg x-show="!isStopwatchRunning" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            <svg x-show="isStopwatchRunning" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            <span x-text="isStopwatchRunning ? 'Lap' : 'Reset'"></span>
                        </button>
                    </div>

                    {{-- Lap list --}}
                    <div x-show="laps.length > 0" class="bg-gray-700 rounded-2xl p-4 max-h-64 overflow-y-auto">
                        <h3 class="text-white font-medium mb-3">Lap Times</h3>
                        <div class="space-y-2">
                            <template x-for="(lap, index) in laps.slice().reverse()" :key="index">
                                <div class="flex justify-between text-gray-300 text-sm py-2 border-b border-gray-600 last:border-0">
                                    <span x-text="`Lap ${laps.length - index}`"></span>
                                    <span class="font-mono" x-text="formatStopwatch(lap.time)"></span>
                                    <span class="text-gray-400 font-mono" x-text="formatStopwatch(lap.split)"></span>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Minimal page-only CSS --}}
    <style>
        [x-cloak] { display: none !important; }

        /* scrollbar for lap list */
        .overflow-y-auto::-webkit-scrollbar { width: 8px; }
        .overflow-y-auto::-webkit-scrollbar-track { background: #374151; border-radius: 10px; }
        .overflow-y-auto::-webkit-scrollbar-thumb { background: #4B5563; border-radius: 10px; }
        .overflow-y-auto::-webkit-scrollbar-thumb:hover { background: #6B7280; }
    </style>

    {{-- Page JS: Alpine component --}}
    @push('scripts')
    <script>
        function timerApp() {
            return {
                activeTab: 'timer',
                soundEnabled: true,

                // SVG circumference for r=180 => 2πr ≈ 1130.97
                CIRC: 1130,

                // -------------------------
                // TIMER
                // -------------------------
                timeLeft: 25 * 60,
                initialTime: 25 * 60,
                isRunning: false,
                timerInterval: null,

                // -------------------------
                // STOPWATCH
                // -------------------------
                stopwatchTime: 0,
                isStopwatchRunning: false,
                stopwatchInterval: null,
                stopwatchStartTime: 0,

                // Laps
                laps: [],
                lastLapTime: 0,

                // Progress % for circle
                get timerProgress() {
                    return this.initialTime === 0 ? 0 : (this.timeLeft / this.initialTime) * 100;
                },

                // Format timer (seconds -> mm:ss)
                formatTime(seconds) {
                    const mins = Math.floor(seconds / 60);
                    const secs = seconds % 60;
                    return `${mins}:${secs.toString().padStart(2, '0')}`;
                },

                // Preset timer
                setTimer(minutes) {
                    if (this.isRunning) return;
                    this.timeLeft = minutes * 60;
                    this.initialTime = this.timeLeft;
                },

                // Increase/decrease timer
                adjustTime(seconds) {
                    if (this.isRunning) return;
                    this.timeLeft = Math.max(0, this.timeLeft + seconds);
                    this.initialTime = this.timeLeft;
                },

                // Start/pause timer
                toggleTimer() {
                    if (this.isRunning) {
                        clearInterval(this.timerInterval);
                        this.timerInterval = null;
                        this.isRunning = false;
                        return;
                    }

                    this.isRunning = true;
                    this.timerInterval = setInterval(() => {
                        if (this.timeLeft > 0) {
                            this.timeLeft--;
                        } else {
                            this.resetTimer();
                            this.playSound();
                            this.showNotification('Timer finished!', 'Your timer has completed.');
                        }
                    }, 1000);
                },

                // Reset timer back to initialTime
                resetTimer() {
                    clearInterval(this.timerInterval);
                    this.timerInterval = null;
                    this.isRunning = false;
                    this.timeLeft = this.initialTime;
                },

                // Format stopwatch (ms -> mm:ss.xx)
                formatStopwatch(milliseconds) {
                    const totalSeconds = Math.floor(milliseconds / 1000);
                    const mins = Math.floor(totalSeconds / 60);
                    const secs = totalSeconds % 60;
                    const ms = Math.floor((milliseconds % 1000) / 10);
                    return `${mins}:${secs.toString().padStart(2, '0')}.${ms.toString().padStart(2, '0')}`;
                },

                // Start/pause stopwatch
                toggleStopwatch() {
                    if (this.isStopwatchRunning) {
                        clearInterval(this.stopwatchInterval);
                        this.stopwatchInterval = null;
                        this.isStopwatchRunning = false;
                        return;
                    }

                    this.isStopwatchRunning = true;
                    this.stopwatchStartTime = Date.now() - this.stopwatchTime;
                    this.stopwatchInterval = setInterval(() => {
                        this.stopwatchTime = Date.now() - this.stopwatchStartTime;
                    }, 10);
                },

                // Reset stopwatch
                resetStopwatch() {
                    clearInterval(this.stopwatchInterval);
                    this.stopwatchInterval = null;
                    this.isStopwatchRunning = false;
                    this.stopwatchTime = 0;
                    this.stopwatchStartTime = 0;
                    this.laps = [];
                    this.lastLapTime = 0;
                },

                // Add a lap
                addLap() {
                    const currentTime = this.stopwatchTime;
                    const splitTime = currentTime - this.lastLapTime;

                    this.laps.push({ time: currentTime, split: splitTime });
                    this.lastLapTime = currentTime;

                    this.playSound();
                },

                // Fullscreen toggle
                toggleFullscreen() {
                    const el = document.documentElement;
                    if (!document.fullscreenElement) {
                        el.requestFullscreen?.();
                    } else {
                        document.exitFullscreen?.();
                    }
                },

                // Beep sound using Web Audio API
                playSound() {
                    if (!this.soundEnabled) return;

                    try {
                        const audioContext = new (window.AudioContext || window.webkitAudioContext)();
                        const oscillator = audioContext.createOscillator();
                        const gainNode = audioContext.createGain();

                        oscillator.connect(gainNode);
                        gainNode.connect(audioContext.destination);

                        oscillator.frequency.value = 800;
                        oscillator.type = 'sine';

                        gainNode.gain.setValueAtTime(0.3, audioContext.currentTime);
                        gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.5);

                        oscillator.start(audioContext.currentTime);
                        oscillator.stop(audioContext.currentTime + 0.5);
                    } catch (e) {
                        console.log('Audio not supported');
                    }
                },

                // Browser notification fallback to alert
                showNotification(title, body) {
                    if ('Notification' in window && Notification.permission === 'granted') {
                        new Notification(title, { body });
                    } else if ('Notification' in window && Notification.permission !== 'denied') {
                        Notification.requestPermission().then(permission => {
                            if (permission === 'granted') new Notification(title, { body });
                        });
                    } else {
                        alert(title);
                    }
                }
            }
        }
    </script>
    @endpush

</x-layouts.game-side-bar>
