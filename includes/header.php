<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>TalentNest</title>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#1111d4",
                        "accent-green": "#00d26a",
                        "background-dark": "#0a0a1a",
                        "surface-dark": "#13132b",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"]
                    },
                    boxShadow: {
                        'neumorphic': '5px 5px 10px rgba(0, 0, 0, 0.4), -5px -5px 10px rgba(255, 255, 255, 0.05)',
                        'neumorphic-pressed': 'inset 5px 5px 10px rgba(0, 0, 0, 0.4), inset -5px -5px 10px rgba(255, 255, 255, 0.05)',
                        'glass': '0 4px 30px rgba(0, 0, 0, 0.1)',
                    }
                },
            },
        }
    </script>
    <style>
        .glass-panel {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .glass-card-strong {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.08) 0%, rgba(255, 255, 255, 0.02) 100%);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
        }
        .text-glow {
            text-shadow: 0 0 20px rgba(17, 17, 212, 0.5);
        }
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        body {
            min-height: 100vh;
        }
    </style>
</head>
<body class="bg-background-dark text-white font-display antialiased overflow-x-hidden selection:bg-primary selection:text-white">
    <div class="fixed top-[-10%] right-[-20%] w-[300px] h-[300px] bg-primary/40 rounded-full blur-[100px] pointer-events-none z-0"></div>
    <div class="fixed bottom-[10%] left-[-10%] w-[250px] h-[250px] bg-accent-green/20 rounded-full blur-[100px] pointer-events-none z-0"></div>
    
    <div class="relative z-10 flex flex-col min-h-screen">
        <header class="sticky top-4 z-50 px-4 md:px-8">
            <div class="glass-card-strong rounded-full px-6 py-3 flex items-center justify-between max-w-7xl mx-auto border border-white/10 shadow-[0_0_15px_rgba(0,0,0,0.5)]">
                <div class="flex items-center gap-2">
                    <a href="index.php" class="flex items-center gap-3 group">
                        <div class="relative flex items-center justify-center size-10 rounded-xl bg-gradient-to-br from-primary to-blue-600 shadow-lg shadow-primary/30 overflow-hidden group-hover:shadow-primary/50 transition-all duration-300">
                            <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                            <span class="material-symbols-outlined text-white text-[24px] relative z-10">hub</span>
                        </div>
                        <h1 class="text-xl font-bold tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-white to-gray-400 group-hover:to-white transition-all duration-300">TalentNest</h1>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <nav class="hidden md:flex items-center gap-1 p-1 rounded-full bg-white/5 border border-white/5 backdrop-blur-sm">
                    <a href="index.php" class="px-5 py-2 text-sm font-medium text-gray-300 hover:text-white hover:bg-white/10 rounded-full transition-all duration-300">Home</a>
                    <a href="jobs.php" class="px-5 py-2 text-sm font-medium text-gray-300 hover:text-white hover:bg-white/10 rounded-full transition-all duration-300">Find Jobs</a>
                    <a href="employer_dashboard.php" class="px-5 py-2 text-sm font-medium text-gray-300 hover:text-white hover:bg-white/10 rounded-full transition-all duration-300">Employers</a>
                    <a href="faq.php" class="px-5 py-2 text-sm font-medium text-gray-300 hover:text-white hover:bg-white/10 rounded-full transition-all duration-300">FAQ</a>
                </nav>

                <div class="flex items-center gap-4">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <?php 
                            $userName = $_SESSION['user_name'] ?? 'User';
                            $displayName = !empty($userName) ? explode(' ', $userName)[0] : 'User';
                            
                            $dashboardLink = 'seeker_profile.php'; // Default
                            if (isset($_SESSION['user_role'])) {
                                if ($_SESSION['user_role'] === 'employer') {
                                    $dashboardLink = 'employer_dashboard.php';
                                }
                            }
                        ?>
                        <div class="hidden md:flex items-center gap-4 pl-4 border-l border-white/10">
                            <div class="flex flex-col items-end">
                                <span class="text-xs text-gray-400">Welcome back</span>
                                <span class="text-sm font-semibold text-white"><?php echo htmlspecialchars($displayName); ?></span>
                            </div>
                            <div class="relative group">
                                <div class="size-10 rounded-full bg-cover bg-center border-2 border-white/20 cursor-pointer group-hover:border-primary transition-colors duration-300" 
                                     onclick="window.location.href='<?php echo $dashboardLink; ?>'" 
                                     style="background-image: url('https://ui-avatars.com/api/?name=<?php echo urlencode($userName); ?>&background=random');">
                                </div>
                                <div class="absolute right-0 top-full mt-2 w-48 py-2 bg-[#1a1a2e] border border-white/10 rounded-xl shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform origin-top-right z-50">
                                    <a href="<?php echo $dashboardLink; ?>" class="block px-4 py-2 text-sm text-gray-300 hover:bg-white/5 hover:text-white">Dashboard</a>
                                    <a href="actions/auth_code.php?logout=true" class="block px-4 py-2 text-sm text-red-400 hover:bg-white/5 hover:text-red-300">Logout</a>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="hidden md:flex items-center gap-3">
                            <a href="login.php" class="text-sm font-medium text-gray-300 hover:text-white transition-colors px-3 py-2">Login</a>
                            <a href="register.php" class="relative px-6 py-2.5 text-sm font-bold text-white bg-primary rounded-full overflow-hidden group shadow-[0_0_20px_rgba(17,17,212,0.4)] hover:shadow-[0_0_30px_rgba(17,17,212,0.6)] transition-all duration-300">
                                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700"></div>
                                <span class="relative z-10">Get Started</span>
                            </a>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Mobile Menu Button -->
                    <button id="mobile-menu-btn" class="md:hidden p-2 rounded-full hover:bg-white/10 transition-colors text-white">
                        <span class="material-symbols-outlined">menu</span>
                    </button>
                </div>
            </div>
        </header>

        <!-- Mobile Navigation Menu -->
        <div id="mobile-menu" class="fixed inset-0 z-40 bg-background-dark/95 backdrop-blur-xl transform translate-x-full transition-transform duration-300 md:hidden flex flex-col items-center justify-center gap-8">
            <button id="close-menu-btn" class="absolute top-6 right-6 p-2 rounded-full hover:bg-white/10">
                <span class="material-symbols-outlined text-white text-3xl">close</span>
            </button>
            <a href="index.php" class="text-2xl font-bold text-white">Home</a>
            <a href="jobs.php" class="text-2xl font-bold text-white">Find Jobs</a>
            <a href="employer_dashboard.php" class="text-2xl font-bold text-white">Employers</a>
            <a href="faq.php" class="text-2xl font-bold text-white">FAQ</a>
            
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="<?php echo $_SESSION['user_role'] == 'employer' ? 'employer_dashboard.php' : 'seeker_profile.php'; ?>" class="text-2xl font-bold text-white">Profile</a>
                <a href="actions/auth_code.php?logout=true" class="text-2xl font-bold text-red-400">Logout</a>
            <?php else: ?>
                <a href="login.php" class="text-2xl font-bold text-white">Login</a>
                <a href="register.php" class="text-2xl font-bold text-primary">Sign Up</a>
            <?php endif; ?>
        </div>

        <script>
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const closeMenuBtn = document.getElementById('close-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');

            mobileMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.remove('translate-x-full');
            });

            closeMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.add('translate-x-full');
            });
        </script>
        
        <main class="flex-grow">
