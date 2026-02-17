<?php 
include 'includes/header.php'; 
require_once 'includes/functions.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'employer') {
    echo "<script>window.location.href='login.php';</script>";
    exit();
}

$my_jobs = getJobsByEmployer($_SESSION['user_id']);
?>

<div class="max-w-7xl mx-auto pb-20">
    <!-- Header Section -->
    <div class="px-4 pt-8 pb-2">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="relative group cursor-pointer">
                    <div class="absolute -inset-0.5 rounded-full bg-gradient-to-r from-primary to-accent-green opacity-75 blur group-hover:opacity-100 transition duration-200"></div>
                    <div class="relative size-12 rounded-full bg-surface-dark overflow-hidden border-2 border-background-dark">
                        <img class="w-full h-full object-cover" data-alt="Shell Petroleum company logo" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBIrv_OZfl0xFyJULvIhyn_XroGSw0EcKSTkbftxolHmgkgRKrd_PsMYfHEOxN8DS1h-WSCPy16ObHMxtXULxsJ0vUlCpAqqfhPy6WQekqAGU-eU5oe2fS3AnheBFAC0eK_YH438mz9J00EnprmonC9EUS7o8zW4ChSJTNferPYcmHF21hkQ78iFVF-4cCsWVYJgzd9W_dIbz4ZxceEBUGE8TAa5-FJegR-v41nclStm9_I7wUU0vwHZSJwpFkx8se5WGlfy9Fovh5B"/>
                    </div>
                </div>
                <div class="flex flex-col">
                    <span class="text-xs text-slate-400 font-medium uppercase tracking-wider">Dashboard</span>
                    <h2 class="text-lg font-bold leading-tight tracking-tight text-white">Hello, Shell Petroleum</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Bar -->
    <section class="px-4 py-4">
        <div class="relative flex w-full items-center">
            <span class="absolute left-4 text-slate-500 material-symbols-outlined">search</span>
            <input class="w-full bg-[#101022] shadow-[inset_4px_4px_8px_#090913,inset_-4px_-4px_8px_#171731] border-none rounded-xl py-3.5 pl-12 pr-4 text-base text-white placeholder-slate-500 focus:outline-none focus:ring-1 focus:ring-primary/50" placeholder="Search jobs, candidates..." type="text"/>
        </div>
    </section>

    <!-- Stats Overview -->
    <section class="mt-2">
        <div class="flex items-center justify-between px-4 mb-3">
            <h3 class="text-xl font-bold tracking-tight text-white">Overview</h3>
            <span class="text-xs font-medium text-primary cursor-pointer hover:text-white transition-colors">View Report</span>
        </div>
        <!-- Horizontal Scroll Container -->
        <div class="flex gap-4 overflow-x-auto px-4 pb-4 snap-x no-scrollbar">
            <!-- Card 1 -->
            <div class="glass-panel min-w-[160px] flex-1 rounded-2xl p-5 relative overflow-hidden group snap-start">
                <div class="absolute -right-4 -top-4 size-16 rounded-full bg-primary/20 blur-xl group-hover:bg-primary/30 transition-all duration-500"></div>
                <div class="relative z-10 flex flex-col gap-2">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="material-symbols-outlined text-slate-400 text-[20px]">work</span>
                        <span class="text-sm font-medium text-slate-300">Active Jobs</span>
                    </div>
                    <p class="text-3xl font-bold text-white tracking-tight">4</p>
                    <div class="flex items-center gap-1 text-accent-green text-xs font-medium bg-accent-green/10 self-start px-2 py-0.5 rounded-full">
                        <span class="material-symbols-outlined text-[14px]">trending_up</span>
                        <span>+1 this week</span>
                    </div>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="glass-panel min-w-[160px] flex-1 rounded-2xl p-5 relative overflow-hidden group snap-start">
                <div class="absolute -right-4 -top-4 size-16 rounded-full bg-accent-green/20 blur-xl group-hover:bg-accent-green/30 transition-all duration-500"></div>
                <div class="relative z-10 flex flex-col gap-2">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="material-symbols-outlined text-slate-400 text-[20px]">group</span>
                        <span class="text-sm font-medium text-slate-300">Candidates</span>
                    </div>
                    <p class="text-3xl font-bold text-white tracking-tight">12</p>
                    <div class="flex items-center gap-1 text-accent-green text-xs font-medium bg-accent-green/10 self-start px-2 py-0.5 rounded-full">
                        <span class="material-symbols-outlined text-[14px]">trending_up</span>
                        <span>+5 new</span>
                    </div>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="glass-panel min-w-[160px] flex-1 rounded-2xl p-5 relative overflow-hidden group snap-start">
                <div class="absolute -right-4 -top-4 size-16 rounded-full bg-purple-500/20 blur-xl group-hover:bg-purple-500/30 transition-all duration-500"></div>
                <div class="relative z-10 flex flex-col gap-2">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="material-symbols-outlined text-slate-400 text-[20px]">visibility</span>
                        <span class="text-sm font-medium text-slate-300">Views</span>
                    </div>
                    <p class="text-3xl font-bold text-white tracking-tight">1.2k</p>
                    <div class="flex items-center gap-1 text-accent-green text-xs font-medium bg-accent-green/10 self-start px-2 py-0.5 rounded-full">
                        <span class="material-symbols-outlined text-[14px]">trending_up</span>
                        <span>+12%</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Manage Listings -->
    <section class="mt-4 px-4 flex-1">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-bold tracking-tight text-white">Manage Listings</h3>
            <button class="bg-primary hover:bg-primary/90 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors shadow-lg shadow-primary/20">
                <span class="material-symbols-outlined text-[20px]">add</span>
                <span class="text-sm font-bold">Post Job</span>
            </button>
        </div>
        <div class="flex flex-col gap-4">
            <?php foreach ($my_jobs as $job): ?>
            <!-- Job Item -->
            <div class="glass-panel rounded-2xl p-4 flex items-center justify-between group cursor-pointer hover:bg-white/5 transition-colors">
                <div class="flex items-center gap-4">
                    <div class="size-12 rounded-xl bg-gradient-to-br from-primary/80 to-blue-900 flex items-center justify-center shadow-lg shadow-primary/20">
                        <span class="material-symbols-outlined text-white">work</span>
                    </div>
                    <div>
                        <h4 class="text-base font-bold text-white group-hover:text-primary transition-colors"><?php echo htmlspecialchars($job['title']); ?></h4>
                        <div class="flex items-center gap-2 text-xs text-slate-400">
                            <span><?php echo htmlspecialchars($job['location']); ?></span>
                            <span class="size-1 rounded-full bg-slate-600"></span>
                            <span><?php echo htmlspecialchars($job['job_type']); ?></span>
                            <span class="size-1 rounded-full bg-slate-600"></span>
                            <span>Posted <?php echo timeAgo($job['created_at']); ?></span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <div class="flex flex-col items-end">
                        <span class="text-lg font-bold text-white"><?php echo getApplicationCountForJob($job['id']); ?></span>
                        <span class="text-xs text-slate-400">Applicants</span>
                    </div>
                    <button class="p-2 hover:bg-white/10 rounded-lg transition-colors text-slate-400 hover:text-white">
                        <span class="material-symbols-outlined">more_vert</span>
                    </button>
                </div>
            </div>
            <?php endforeach; ?>
            <?php if (empty($my_jobs)): ?>
                <div class="text-center text-gray-400 py-8">You haven't posted any jobs yet.</div>
            <?php endif; ?>
        </div>
    </section>
</div>

<?php include 'includes/footer.php'; ?>