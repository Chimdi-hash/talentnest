<?php 
include 'includes/header.php'; 
require_once 'includes/functions.php';

$keyword = $_GET['q'] ?? '';
$location = $_GET['location'] ?? '';
$type = $_GET['type'] ?? '';
$sort = $_GET['sort'] ?? '';

$jobs = searchJobs($keyword, $location, $type, $sort, 20);
?>

<form action="jobs.php" method="GET" id="searchForm">
    <div class="px-6 py-6">
        <div class="relative group">
            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                <span class="material-symbols-outlined text-slate-400 group-focus-within:text-primary transition-colors">search</span>
            </div>
            <input name="q" value="<?php echo htmlspecialchars($keyword); ?>" class="block w-full rounded-2xl border-0 bg-white/5 py-4 pl-12 pr-4 text-white placeholder:text-slate-500 ring-1 ring-white/10 focus:ring-2 focus:ring-primary/50 focus:bg-white/10 transition-all backdrop-blur-sm shadow-inner" placeholder="Search generic roles..." type="text" onchange="this.form.submit()"/>
            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                <button type="submit" class="p-2 text-slate-400 hover:text-white transition-colors">
                    <span class="material-symbols-outlined" style="font-size: 20px;">tune</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Hidden Inputs for Filters -->
    <input type="hidden" name="location" id="locationInput" value="<?php echo htmlspecialchars($location); ?>">
    <input type="hidden" name="type" id="typeInput" value="<?php echo htmlspecialchars($type); ?>">
    <input type="hidden" name="sort" id="sortInput" value="<?php echo htmlspecialchars($sort); ?>">

    <!-- Filter Chips (Neumorphic) -->
    <div class="w-full overflow-x-auto no-scrollbar pl-6 pb-6">
        <div class="flex gap-4 pr-6">
            <a href="jobs.php" class="flex shrink-0 items-center gap-2 rounded-xl <?php echo (empty($location) && empty($type) && empty($sort)) ? 'bg-surface-dark shadow-neumorphic-pressed border border-primary/20 text-primary' : 'bg-surface-dark shadow-neumorphic-dark text-slate-300'; ?> px-5 py-3 transition-all">
                <span class="text-sm font-semibold">All Jobs</span>
            </a>
            
            <button type="button" onclick="toggleFilter('location', 'Remote')" class="flex shrink-0 items-center gap-2 rounded-xl <?php echo $location === 'Remote' ? 'bg-surface-dark shadow-neumorphic-pressed border border-primary/20 text-primary' : 'bg-surface-dark shadow-neumorphic-dark text-slate-300'; ?> px-5 py-3 transition-all">
                <span class="text-sm font-medium">Remote</span>
            </button>
            
            <button type="button" onclick="toggleFilter('location', 'Port Harcourt')" class="flex shrink-0 items-center gap-2 rounded-xl <?php echo $location === 'Port Harcourt' ? 'bg-surface-dark shadow-neumorphic-pressed border border-primary/20 text-primary' : 'bg-surface-dark shadow-neumorphic-dark text-slate-300'; ?> px-5 py-3 transition-all">
                <span class="text-sm font-medium">Port Harcourt</span>
            </button>
            
            <button type="button" onclick="toggleFilter('sort', 'salary_desc')" class="flex shrink-0 items-center gap-2 rounded-xl <?php echo $sort === 'salary_desc' ? 'bg-surface-dark shadow-neumorphic-pressed border border-primary/20 text-primary' : 'bg-surface-dark shadow-neumorphic-dark text-slate-300'; ?> px-5 py-3 transition-all">
                <span class="text-sm font-medium">₦ Salary</span>
            </button>
            
            <button type="button" onclick="toggleFilter('type', 'Full-time')" class="flex shrink-0 items-center gap-2 rounded-xl <?php echo $type === 'Full-time' ? 'bg-surface-dark shadow-neumorphic-pressed border border-primary/20 text-primary' : 'bg-surface-dark shadow-neumorphic-dark text-slate-300'; ?> px-5 py-3 transition-all">
                <span class="text-sm font-medium">Full-time</span>
            </button>
        </div>
    </div>
</form>

<script>
function toggleFilter(name, value) {
    const input = document.getElementById(name + 'Input');
    if (input.value === value) {
        input.value = ''; // Toggle off
    } else {
        input.value = value; // Toggle on
    }
    document.getElementById('searchForm').submit();
}
</script>

<!-- Section Title -->
<div class="flex items-center justify-between px-6 mb-4">
    <h2 class="text-xl font-bold tracking-tight text-white">Featured Jobs</h2>
    <a class="text-sm font-medium text-primary hover:text-primary/80 transition-colors" href="jobs.php">See all</a>
</div>

<!-- Job Cards List -->
<div class="flex flex-col gap-5 px-6 pb-8">
    <?php foreach ($jobs as $job): ?>
    <!-- Card -->
    <div class="relative overflow-hidden rounded-2xl bg-glass-gradient glass-card shadow-glass group hover:bg-white/10 transition-all duration-300">
        <div class="absolute top-0 right-0 p-4">
            <button class="text-slate-400 hover:text-white transition-colors">
                <span class="material-symbols-outlined" style="font-size: 24px;">bookmark</span>
            </button>
        </div>
        <div class="p-5">
            <div class="flex items-start gap-4 mb-4">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-white/10 backdrop-blur-md border border-white/5 overflow-hidden">
                    <?php if ($job['company_logo']): ?>
                        <img src="<?php echo htmlspecialchars($job['company_logo']); ?>" alt="Logo" class="w-full h-full object-cover">
                    <?php else: ?>
                        <span class="material-symbols-outlined text-white" style="font-size: 28px;">work</span>
                    <?php endif; ?>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-white group-hover:text-primary transition-colors"><?php echo htmlspecialchars($job['title']); ?></h3>
                    <p class="text-sm text-slate-400"><?php echo htmlspecialchars($job['company_name']); ?> • <?php echo htmlspecialchars($job['location']); ?></p>
                </div>
            </div>
            <div class="flex flex-wrap gap-2 mb-4">
                <span class="inline-flex items-center rounded-lg bg-white/5 px-2.5 py-1 text-xs font-medium text-slate-300 ring-1 ring-inset ring-white/10"><?php echo htmlspecialchars($job['job_type']); ?></span>
                <span class="inline-flex items-center rounded-lg bg-white/5 px-2.5 py-1 text-xs font-medium text-slate-300 ring-1 ring-inset ring-white/10"><?php echo timeAgo($job['created_at']); ?></span>
            </div>
            <div class="flex items-center justify-between border-t border-white/10 pt-4 mt-2">
                <div class="flex flex-col">
                    <span class="text-xs text-slate-500 font-medium">Salary</span>
                    <span class="text-sm font-bold text-accent-green"><?php echo formatSalary($job['salary_range']); ?><span class="text-xs text-slate-500 font-normal">/mo</span></span>
                </div>
                <button onclick="window.location.href='job_details.php?id=<?php echo $job['id']; ?>'" class="rounded-lg bg-primary px-4 py-2 text-sm font-bold text-white shadow-lg shadow-primary/25 hover:bg-primary/90 transition-all">
                    Apply Now
                </button>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <?php if (empty($jobs)): ?>
        <div class="w-full text-center text-gray-400 py-8">No jobs found.</div>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>