<?php 
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: admin_login.php");
    exit();
}
include 'includes/header.php'; 
?>

<div class="max-w-7xl mx-auto pb-20">
    <main class="flex-1 flex flex-col gap-6 px-4 pt-6">
        <?php if (isset($_GET['success'])): ?>
            <div class="bg-green-500/10 border border-green-500/20 text-green-400 px-4 py-3 rounded-xl text-sm">
                <?php echo htmlspecialchars($_GET['success']); ?>
            </div>
        <?php endif; ?>
        <?php if (isset($_GET['error'])): ?>
            <div class="bg-red-500/10 border border-red-500/20 text-red-400 px-4 py-3 rounded-xl text-sm">
                <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>
        <!-- Greeting & Search -->
        <div class="flex flex-col gap-4">
            <div>
                <h2 class="text-2xl font-bold text-white">Good Morning, Admin</h2>
                <p class="text-slate-400 text-sm">Here's what's happening in Port Harcourt today.</p>
            </div>
            <!-- Neumorphic Search Bar -->
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <span class="material-symbols-outlined text-slate-500">search</span>
                </div>
                <input class="w-full bg-[#101022] text-white pl-11 pr-4 py-3.5 rounded-xl border-none shadow-[inset_4px_4px_8px_#0b0b18,inset_-4px_-4px_8px_#25253c] focus:ring-2 focus:ring-primary/50 focus:outline-none placeholder:text-slate-600 transition-all" placeholder="Search jobs, employers, or logs..." type="text"/>
            </div>
        </div>
        <!-- KPI Cards (Horizontal Scroll) -->
        <div>
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-lg font-semibold text-white">Overview</h3>
                <button class="text-xs text-primary font-medium hover:text-white transition-colors">View Report</button>
            </div>
            <div class="flex gap-4 overflow-x-auto no-scrollbar pb-4 -mx-4 px-4">
                <!-- Card 1 -->
                <div class="glass-panel min-w-[160px] p-4 rounded-2xl flex flex-col gap-3 relative overflow-hidden group">
                    <div class="absolute -right-4 -top-4 bg-primary/20 size-20 rounded-full blur-xl group-hover:bg-primary/30 transition-all"></div>
                    <div class="flex items-start justify-between">
                        <div class="p-2 bg-surface-dark rounded-lg text-primary">
                            <span class="material-symbols-outlined">work</span>
                        </div>
                        <span class="flex items-center text-xs font-medium text-accent-green bg-accent-green/10 px-2 py-0.5 rounded-full">
                            <span class="material-symbols-outlined text-[12px] mr-1">trending_up</span> 12%
                        </span>
                    </div>
                    <div>
                        <p class="text-slate-400 text-xs font-medium uppercase tracking-wider">Active Jobs</p>
                        <p class="text-white text-2xl font-bold mt-1">1,240</p>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="glass-panel min-w-[160px] p-4 rounded-2xl flex flex-col gap-3 relative overflow-hidden group">
                    <div class="absolute -right-4 -top-4 bg-purple-500/20 size-20 rounded-full blur-xl group-hover:bg-purple-500/30 transition-all"></div>
                    <div class="flex items-start justify-between">
                        <div class="p-2 bg-surface-dark rounded-lg text-purple-400">
                            <span class="material-symbols-outlined">group</span>
                        </div>
                        <span class="flex items-center text-xs font-medium text-accent-green bg-accent-green/10 px-2 py-0.5 rounded-full">
                            +5%
                        </span>
                    </div>
                    <div>
                        <p class="text-slate-400 text-xs font-medium uppercase tracking-wider">Seekers</p>
                        <p class="text-white text-2xl font-bold mt-1">5,430</p>
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="glass-panel min-w-[160px] p-4 rounded-2xl flex flex-col gap-3 relative overflow-hidden group">
                    <div class="absolute -right-4 -top-4 bg-accent-green/20 size-20 rounded-full blur-xl group-hover:bg-accent-green/30 transition-all"></div>
                    <div class="flex items-start justify-between">
                        <div class="p-2 bg-surface-dark rounded-lg text-accent-green">
                            <span class="material-symbols-outlined">payments</span>
                        </div>
                        <span class="flex items-center text-xs font-medium text-accent-green bg-accent-green/10 px-2 py-0.5 rounded-full">
                            +8%
                        </span>
                    </div>
                    <div>
                        <p class="text-slate-400 text-xs font-medium uppercase tracking-wider">Revenue</p>
                        <p class="text-white text-2xl font-bold mt-1">₦4.5M</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Analytics Chart -->
        <div class="glass-panel rounded-2xl p-5 relative">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-white font-semibold">Application Volume</h3>
                    <p class="text-slate-400 text-xs">Weekly insights</p>
                </div>
                <div class="text-right">
                    <p class="text-2xl font-bold text-white">850</p>
                    <p class="text-accent-green text-xs font-medium flex items-center justify-end">
                        <span class="material-symbols-outlined text-[14px] mr-0.5">arrow_upward</span> 124 new
                    </p>
                </div>
            </div>
            <!-- Chart SVG -->
            <div class="w-full h-32 relative">
                <svg class="w-full h-full overflow-visible" preserveaspectratio="none" viewbox="0 0 400 150">
                    <defs>
                        <lineargradient id="chartGradient" x1="0" x2="0" y1="0" y2="1">
                            <stop offset="0%" stop-color="#1111d4" stop-opacity="0.5"></stop>
                            <stop offset="100%" stop-color="#1111d4" stop-opacity="0"></stop>
                        </lineargradient>
                    </defs>
                    <!-- Grid Lines -->
                    <line stroke="#282839" stroke-width="1" x1="0" x2="400" y1="150" y2="150"></line>
                    <line stroke="#282839" stroke-dasharray="4 4" stroke-width="1" x1="0" x2="400" y1="100" y2="100"></line>
                    <line stroke="#282839" stroke-dasharray="4 4" stroke-width="1" x1="0" x2="400" y1="50" y2="50"></line>
                    <!-- Area Path -->
                    <path d="M0 120 C 40 120, 60 80, 100 80 S 160 110, 200 70 S 260 90, 300 50 S 360 20, 400 40 V 150 H 0 Z" fill="url(#chartGradient)"></path>
                    <!-- Line Path -->
                    <path d="M0 120 C 40 120, 60 80, 100 80 S 160 110, 200 70 S 260 90, 300 50 S 360 20, 400 40" fill="none" stroke="#1111d4" stroke-linecap="round" stroke-width="3"></path>
                    <!-- Current Point -->
                    <circle cx="400" cy="40" fill="#ffffff" r="4" stroke="#1111d4" stroke-width="2"></circle>
                </svg>
            </div>
            <div class="flex justify-between mt-2 text-xs text-slate-500 font-medium">
                <span>Mon</span>
                <span>Tue</span>
                <span>Wed</span>
                <span>Thu</span>
                <span>Fri</span>
                <span>Sat</span>
                <span>Sun</span>
            </div>
        </div>
        <!-- Moderation Queue -->
        <div>
            <h3 class="text-lg font-semibold text-white mb-3">Needs Action</h3>
            <div class="flex flex-col gap-3">
                <!-- Item 1: Job Approval -->
                <div class="glass-panel p-4 rounded-xl flex flex-col gap-4">
                    <div class="flex items-start gap-3">
                        <div class="size-10 rounded-lg bg-white/10 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-yellow-400">verified_user</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-start">
                                <h4 class="text-white font-medium text-sm truncate">Senior DevOps Engineer</h4>
                                <span class="text-[10px] text-yellow-400 bg-yellow-400/10 px-2 py-0.5 rounded border border-yellow-400/20">Pending</span>
                            </div>
                            <p class="text-slate-400 text-xs mt-0.5">Shell Nigeria • Port Harcourt</p>
                            <p class="text-slate-500 text-[10px] mt-1">Posted 2h ago</p>
                        </div>
                    </div>
                    <div class="flex gap-3 mt-1">
                        <button class="flex-1 h-9 rounded-lg bg-surface-dark border border-white/5 text-slate-300 text-xs font-semibold hover:bg-red-500/10 hover:text-red-400 hover:border-red-500/30 transition-all flex items-center justify-center gap-1">
                            <span class="material-symbols-outlined text-[16px]">close</span> Reject
                        </button>
                        <button class="flex-1 h-9 rounded-lg bg-primary text-white text-xs font-semibold shadow-lg shadow-primary/30 hover:bg-primary/90 transition-all flex items-center justify-center gap-1">
                            <span class="material-symbols-outlined text-[16px]">check</span> Approve
                        </button>
                    </div>
                </div>
                <!-- Item 2: User Report -->
                <div class="glass-panel p-4 rounded-xl flex flex-col gap-4">
                    <div class="flex items-start gap-3">
                        <div class="size-10 rounded-lg bg-white/10 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-red-400">flag</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-start">
                                <h4 class="text-white font-medium text-sm truncate">Scam Alert: Fake Agency</h4>
                                <span class="text-[10px] text-red-400 bg-red-400/10 px-2 py-0.5 rounded border border-red-400/20">High Priority</span>
                            </div>
                            <p class="text-slate-400 text-xs mt-0.5">Reported by 3 users</p>
                            <p class="text-slate-500 text-[10px] mt-1">ID: #USR-9921</p>
                        </div>
                    </div>
                    <div class="flex gap-3 mt-1">
                        <button class="flex-1 h-9 rounded-lg bg-surface-dark border border-white/5 text-slate-300 text-xs font-semibold hover:bg-white/5 transition-all flex items-center justify-center gap-1">
                            Dismiss
                        </button>
                        <button class="flex-1 h-9 rounded-lg bg-surface-dark border border-red-500/30 text-red-400 text-xs font-semibold hover:bg-red-500/10 transition-all flex items-center justify-center gap-1">
                            Ban User
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Password Reset Section -->
        <div>
            <h3 class="text-lg font-semibold text-white mb-3">User Management</h3>
            <div class="glass-panel p-5 rounded-xl">
                <h4 class="text-white font-medium text-sm mb-2">Reset User Password</h4>
                <p class="text-slate-400 text-xs mb-4">Enter the user's email address to generate a new password and send it via email.</p>
                
                <form action="actions/admin_actions.php" method="POST" class="flex flex-col gap-3">
                    <input type="hidden" name="action" value="reset_password">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-slate-500 text-[20px]">mail</span>
                        </div>
                        <input type="email" name="email" required 
                            class="w-full bg-[#101022] text-white pl-10 pr-4 py-3 rounded-lg border border-white/5 focus:border-primary/50 focus:ring-1 focus:ring-primary/50 focus:outline-none placeholder:text-slate-600 text-sm transition-all" 
                            placeholder="user@example.com">
                    </div>
                    <button type="submit" class="bg-primary hover:bg-primary/90 text-white font-medium py-2.5 px-4 rounded-lg text-sm transition-colors shadow-lg shadow-primary/20 flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">lock_reset</span>
                        Reset Password
                    </button>
                </form>
            </div>
        </div>
    </main>
</div>

<?php include 'includes/footer.php'; ?>