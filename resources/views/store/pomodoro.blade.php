<x-layouts.game-side-bar title="Timer & Stopwatch">

    <div class="min-h-screen flex items-center justify-center p-4 bg-gray-900">
        <div x-data="timerApp()" class="w-full max-w-2xl">
            <div class="bg-gray-800 rounded-3xl p-8 shadow-2xl">

                {{-- Tab Buttons --}}
                <div class="flex gap-4 mb-8">
                    <button
                        @click="activeTab = 'timer'"
                        :class="activeTab === 'timer' ? 'bg-yellow-700' : 'bg-gray-700'"
                        class="flex items-center gap-2 px-6 py-3 rounded-full text-white font-medium transition-colors hover:bg-yellow-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Timer
                    </button>

                    <button
                        @click="activeTab = 'stopwatch'"
                        :class="activeTab === 'stopwatch' ? 'bg-yellow-700' : 'bg-gray-700'"
                        class="flex items-center gap-2 px-6 py-3 rounded-full text-white font-medium transition-colors hover:bg-yellow-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" stroke-width="2"></circle>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 6v6l4 2"></path>
                        </svg>
                        Stopwatch
                    </button>

                    {{-- Sound & Fullscreen --}}
                    <div class="ml-auto flex gap-3">
                        <button class="text-yellow-600 hover:text-yellow-500 transition-colors" title="Sound (placeholder)">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77s-2.99-7.86-7-8.77z"></path>
                            </svg>
                        </button>

                        <button @click="toggleFullscreen"
                                class="text-yellow-600 hover:text-yellow-500 transition-colors"
                                title="Fullscreen">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- TIMER VIEW --}}
                <div x-show="activeTab === 'timer'" x-cloak class="space-y-8">
                    <div class="relative flex items-center justify-center">
                        <svg class="transform -rotate-90" width="400" height="400">
                            <circle cx="200" cy="200" r="180" stroke="#4B5563" stroke-width="3" fill="none"></circle>
                            <circle
                                cx="200" cy="200" r="180"
                                stroke="#B45309" stroke-width="3" fill="none"
                                :stroke-dasharray="CIRC"
                                :stroke-dashoffset="CIRC - (CIRC * timerProgress / 100)"
                                stroke-linecap="round"
                                class="transition-all duration-1000">
                            </circle>
                        </svg>

                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <div class="text-8xl font-light text-white mb-4" x-text="formatTime(timeLeft)"></div>
                            <div class="flex gap-3">
                                <button @click="adjustTime(-30)"
                                        class="px-6 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-full transition-colors">
                                    -0:30
                                </button>
                                <button @click="adjustTime(60)"
                                        class="px-6 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-full transition-colors">
                                    +1:00
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <button @click="toggleTimer"
                                class="py-5 bg-yellow-700 hover:bg-yellow-600 text-white rounded-2xl font-medium text-lg transition-colors flex items-center justify-center gap-2">
                            <svg x-show="!isRunning" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z"></path>
                            </svg>
                            <svg x-show="isRunning" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M6 4h4v16H6V4zm8 0h4v16h-4V4z"></path>
                            </svg>
                        </button>

                        <button @click="resetTimer"
                                class="py-5 bg-yellow-700 hover:bg-yellow-600 text-white rounded-2xl font-medium text-lg transition-colors flex items-center justify-center gap-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- STOPWATCH VIEW --}}
                <div x-show="activeTab === 'stopwatch'" x-cloak class="space-y-8">
                    <div class="relative flex items-center justify-center">
                        <svg class="transform -rotate-90" width="400" height="400">
                            <circle cx="200" cy="200" r="180" stroke="#4B5563" stroke-width="3" fill="none"></circle>
                            <circle
                                cx="200" cy="200" r="180"
                                stroke="#B45309" stroke-width="3" fill="none"
                                :stroke-dasharray="CIRC"
                                :stroke-dashoffset="CIRC - (CIRC * ((stopwatchTime % 60000) / 60000))"
                                stroke-linecap="round"
                                class="transition-all duration-100">
                            </circle>
                        </svg>

                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <div class="text-8xl font-light text-white" x-text="formatStopwatch(stopwatchTime)"></div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <button @click="toggleStopwatch"
                                class="py-5 bg-yellow-700 hover:bg-yellow-600 text-white rounded-2xl font-medium text-lg transition-colors flex items-center justify-center gap-2">
                            <svg x-show="!isStopwatchRunning" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z"></path>
                            </svg>
                            <svg x-show="isStopwatchRunning" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M6 4h4v16H6V4zm8 0h4v16h-4V4z"></path>
                            </svg>
                        </button>

                        <button @click="resetStopwatch"
                                class="py-5 bg-yellow-700 hover:bg-yellow-600 text-white rounded-2xl font-medium text-lg transition-colors flex items-center justify-center gap-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <style>
        [x-cloak] { display: none !important; }
    </style>

    <script>
        function timerApp() {
            return {
                activeTab: 'timer',

                // SVG circumference for r=180 => 2πr ≈ 1130.97
                CIRC: 1130,

                // Timer
                timeLeft: 25 * 60,
                initialTime: 25 * 60,
                isRunning: false,
                timerInterval: null,

                // Stopwatch
                stopwatchTime: 0,
                isStopwatchRunning: false,
                stopwatchInterval: null,
                stopwatchStartTime: 0,

                get timerProgress() {
                    return this.initialTime === 0 ? 0 : (this.timeLeft / this.initialTime) * 100;
                },

                formatTime(seconds) {
                    const mins = Math.floor(seconds / 60);
                    const secs = seconds % 60;
                    return `${mins}:${secs.toString().padStart(2, '0')}`;
                },

                adjustTime(seconds) {
                    if (this.isRunning) return;
                    this.timeLeft = Math.max(0, this.timeLeft + seconds);
                    this.initialTime = this.timeLeft;
                },

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
                            alert('Timer finished!');
                        }
                    }, 1000);
                },

                resetTimer() {
                    clearInterval(this.timerInterval);
                    this.timerInterval = null;
                    this.isRunning = false;
                    this.timeLeft = this.initialTime; // resets back to what user set
                },

                formatStopwatch(milliseconds) {
                    const totalSeconds = Math.floor(milliseconds / 1000);
                    const mins = Math.floor(totalSeconds / 60);
                    const secs = totalSeconds % 60;
                    const ms = Math.floor((milliseconds % 1000) / 10);
                    return `${mins}:${secs.toString().padStart(2, '0')}.${ms.toString().padStart(2, '0')}`;
                },

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

                resetStopwatch() {
                    clearInterval(this.stopwatchInterval);
                    this.stopwatchInterval = null;
                    this.isStopwatchRunning = false;
                    this.stopwatchTime = 0;
                    this.stopwatchStartTime = 0;
                },

                toggleFullscreen() {
                    const el = document.documentElement;
                    if (!document.fullscreenElement) {
                        el.requestFullscreen?.();
                    } else {
                        document.exitFullscreen?.();
                    }
                }
            }
        }
    </script>

</x-layouts.game-side-bar>
