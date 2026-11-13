<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8" name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farah | Full-Stack Web Developer</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; overflow-x: hidden; }
        section { scroll-margin-top: 90px; perspective: 1400px; }
        
        /* Base Editorial Card */
        .editorial-card {
            box-shadow: 0 10px 30px -10px rgba(44, 44, 44, 0.05);
            transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.5s cubic-bezier(0.16, 1, 0.3, 1) !important;
            transform-style: preserve-3d;
            will-change: transform;
        }

        /* Forced Hover Lift & 3D Tilt Effect */
        .editorial-card:hover {
            transform: translateY(-12px) rotateX(4deg) rotateY(-4deg) scale(1.02) !important;
            box-shadow: -15px 30px 50px -10px rgba(139, 94, 52, 0.25), 0 20px 35px -10px rgba(44, 44, 44, 0.15) !important;
        }

        /* Hero Magazine Cover Elevation */
        .magazine-cover {
            box-shadow: -15px 20px 40px -10px rgba(44, 44, 44, 0.15);
            transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
            transform-style: preserve-3d;
        }
        .magazine-cover:hover {
            transform: rotateY(-5deg) rotateX(5deg) scale(1.03) !important;
            box-shadow: -25px 35px 65px -10px rgba(139, 94, 52, 0.3) !important;
        }

        /* Smooth 3D Scroll Rotation Classes */
        .rot-left {
            opacity: 0;
            transform: perspective(1000px) translateX(-50px) rotateY(-15deg);
            transition: opacity 1.2s cubic-bezier(0.16, 1, 0.3, 1), transform 1.2s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .rot-right {
            opacity: 0;
            transform: perspective(1000px) translateX(50px) rotateY(15deg);
            transition: opacity 1.2s cubic-bezier(0.16, 1, 0.3, 1), transform 1.2s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .rot-up {
            opacity: 0;
            transform: perspective(1000px) translateY(60px) rotateX(10deg);
            transition: opacity 1.2s cubic-bezier(0.16, 1, 0.3, 1), transform 1.2s cubic-bezier(0.16, 1, 0.3, 1);
        }

        /* Active Class jab element viewport mein aaye */
        .rot-left.active,
        .rot-right.active,
        .rot-up.active {
            opacity: 1;
            transform: perspective(1000px) translateX(0) translateY(0) rotateX(0) rotateY(0);
        }
        /* Professional Nav Link Sliding Underline Effect */
        .nav-link {
            position: relative;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 1.5px;
            background-color: #8B5E34;
            transition: width 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .nav-link:hover::after {
            width: 100%;
        }
        /* Active Navigation Link Style */
        .nav-link.active-nav {
            color: #8B5E34 !important;
        }
        .nav-link.active-nav::after {
            width: 100% !important;
        }
    </style>
</head>
<body class="bg-[#F7F4EF] text-[#2C2C2C] antialiased selection:bg-[#E2D6C8]">

    <!-- Navigation Bar -->
    <nav class="sticky top-0 z-50 bg-[#F7F4EF]/85 backdrop-blur-md border-b border-[#E6E0D5] transition-all duration-300">
        <div class="max-w-6xl mx-auto md:px-20 h-20 flex items-center justify-between">
            <a href="#" class="text-xl font-bold tracking-tight text-[#1A1A1A] group">
                Farah  Manzoor<span class="text-[#8B5E34] inline-block group-hover:translate-x-1 transition-transform">.</span>
            </a>

            <div class="hidden md:flex items-center space-x-10 text-sm font-medium text-gray-600">
                <a href="#about" class="nav-link hover:text-[#8B5E34] transition-colors py-1">About</a>
                <a href="#projects" class="nav-link hover:text-[#8B5E34] transition-colors py-1">Projects</a>
                <a href="#skills" class="nav-link hover:text-[#8B5E34] transition-colors py-1">Skills</a>
                @php
                    $settings = \App\Models\Setting::latest()->first();
                @endphp
                    @if(!empty($settings && $settings->resume_path))
                        <a href="{{ asset('storage/' . $settings->resume_path) }}" target="_blank" class="nav-link hover:text-[#8B5E34] transition-colors py-1">
                            Resume
                        </a>
                    @else
                        <span class="text-xs text-gray-400 font-medium uppercase tracking-wider">Resume not uploaded</span>
                    @endif
                <a href="#contact" class="nav-link hover:text-[#8B5E34] transition-colors py-1">Contact</a>
            </div>

            <a href="#contact" class="px-5 py-2.5 text-xs font-semibold uppercase tracking-wider text-white bg-[#1A1A1A] rounded-full hover:bg-[#8B5E34] active:scale-95 transition-all shadow-md hover:shadow-lg">
                Let's Talk
            </a>
        </div>
    </nav>

    <!-- Hero / About Section -->
    <section id="about" class="max-w-6xl mx-auto px-8 pt-16 pb-24 md:pt-24 md:pb-32">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-12 items-center">
            
            <!-- Left Text Content -->
            <div class="md:col-span-7 rot-left">
                <div class="inline-flex items-center space-x-3 mb-6 px-3.5 py-1.5 bg-[#EFECE6] border border-[#E6E0D5] rounded-full">
                    <span class="w-2 h-2 rounded-full bg-[#8B5E34] animate-pulse"></span>
                    <span class="text-xs font-semibold uppercase tracking-widest text-[#8B5E34]">Full-Stack Developer & Educator</span>
                </div>
                <h1 class="text-4xl md:text-6xl font-serif font-bold tracking-tight text-[#1A1A1A] leading-[1.12] mb-6">
                    Crafting digital architectures with <span class="text-[#8B5E34] underline decoration-[#E6E0D5] underline-offset-8">editorial precision</span>.
                </h1>
                <p class="text-lg text-gray-600 leading-relaxed font-light mb-8 max-w-xl">
                    Transitioning academic discipline into robust backend logic. Building clean, scalable web applications using Laravel, PHP, and modern database structures.
                </p>
                <div class="flex flex-wrap items-center gap-5">
                    <a href="#projects" class="group px-7 py-3.5 text-sm font-medium text-white bg-[#1A1A1A] rounded-full hover:bg-[#8B5E34] transition-all duration-300 shadow-md hover:shadow-xl flex items-center gap-2">
                        <span>Explore Works</span>
                        <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
                    </a>
                    @php
                        $settings = \App\Models\Setting::latest()->first();
                    @endphp
                    @if(!empty($settings && $settings->resume_path))
                        <a href="{{ asset('storage/' . $settings->resume_path) }}" target="_blank" class="group px-7 py-3.5 text-sm font-medium text-[#8B5E34] bg-[#EFECE6] border border-[#E6E0D5] rounded-full hover:bg-[#8B5E34] hover:text-white hover:shadow-lg transition-all duration-300 flex items-center gap-2">
                           <span>Resume</span>
                        <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
                        </a>
                    @else
                        <span class="text-xs text-gray-400 font-medium uppercase tracking-wider">Resume not uploaded</span>
                    @endif
                    
                </div>
            </div>

            <!-- Right Magazine Cover --> 
            <div class="md:col-span-5 relative rot-right">
                <div class="absolute -inset-3 bg-gradient-to-tr from-[#8B5E34]/20 to-[#E6E0D5] rounded-3xl transform rotate-3 blur-sm"></div>
                <div class="relative bg-white p-8 rounded-2xl border border-[#E6E0D5] magazine-cover transform -rotate-1 cursor-pointer">
                    <div class="h-48 bg-[#FAF8F5] rounded-xl mb-6 flex items-center justify-center border border-[#EBE5DC] overflow-hidden group relative">
                        <!-- Yahan apni image ka path ya URL dein -->
                        <img src="{{ asset('images/laravel.jpg') }}" alt="Laravel PHP Coding" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                    </div>
                    <h3 class="text-xl font-bold text-[#1A1A1A] mb-2">The Developer Issue</h3>
                    <p class="text-sm text-gray-700 leading-relaxed mb-6 font-normal">
                        A curated collection of backend systems, school management architectures, and full-stack web solutions.
                    </p>
                    <div class="flex items-center justify-between pt-4 border-t border-[#F0ECE4] text-xs text-gray-500 font-medium">
                        <span>Faisalabad, PK</span>
                        <span class="px-2.5 py-1 bg-[#F7F4EF] rounded-md border border-[#E6E0D5] text-[#8B5E34]">2026 Edition</span>
                    </div>
                </div>
            </div> 
            

        </div>
    </section>

    <!-- Projects Section -->
<section id="projects" class="py-16 bg-white border-y border-[#E6E0D5]">
    <div class="w-full px-6 md:px-32">
        
        <!-- Header Banner Area (Fluid & Balanced) -->
        <div class="mb-16 p-6 md:p-8 bg-[#EFECE6] border border-[#E6E0D5] rounded-3xl shadow-sm relative overflow-hidden rot-up">
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-[#8B5E34]/10 rounded-full blur-2xl pointer-events-none"></div>

            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <div class="flex items-center space-x-3 mb-3">
                        <span class="h-[2px] w-8 bg-[#8B5E34]"></span>
                        <span class="text-xs font-semibold uppercase tracking-widest text-[#8B5E34]">Selected Works</span>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-serif font-bold text-[#1A1A1A]">Featured Projects</h2>
                </div>
                
                <div class="flex items-center gap-3 mt-6">
                    <span class="px-4 py-2 bg-[#8B5E34] text-white text-xs font-medium rounded-full shadow-sm tracking-wide">
                        Backend Systems & Architecture
                    </span>
                    {{-- <span class="px-3 py-2 bg-white/75 border border-[#DCD5C9] text-[#1A1A1A] text-xs font-mono rounded-full hidden sm:inline-block">
                        01 / 2026
                    </span> --}}
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-20">
            @forelse($projects ?? [] as $project)
                <div class="rot-up">
                    <div class="group bg-[#FAF7F2] rounded-2xl p-6 border border-[#EBE4D8] hover:border-[#8B5E34] hover:shadow-2xl hover:-translate-y-2 flex flex-col justify-between h-full transition-all duration-500">
                        <div>
                            <!-- Image -->
                            <div class="h-96 rounded-xl mb-5 flex items-center justify-center overflow-hidden relative">
                                @if(!empty($project->thumbnail))
                                    <img src="{{ asset('storage/' . $project->thumbnail) }}" alt="{{ $project->title }}" class="w-full h-full object-cover rounded-xl group-hover:scale-105 transition-transform duration-700 ease-out shadow-sm">
                                @else
                                    <img src="{{ asset('images/school.jpg') }}" alt="{{ $project->title }}" class="w-full h-full object-cover rounded-xl group-hover:scale-105 transition-transform duration-700 ease-out shadow-sm">
                                @endif
                            </div>

                            <!-- Title -->
                            <h3 class="text-xl font-bold text-[#1A1A1A] mb-2 group-hover:text-[#8B5E34] transition-colors">
                                {{ $project->title }}
                            </h3>

                            <!-- Tech Stack -->
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span class="text-[11px] font-semibold px-3 py-1 bg-[#EFE9DF] text-[#1A1A1A] rounded-md border border-[#E0D7C8]">{{ $project->tech_stack }}</span>
                            </div>

                            <!-- Description -->
                            <p class="text-gray-600 text-xs leading-relaxed mb-6 font-medium">
                                {{ $project->description }}
                            </p>
                        </div>

                        <!-- GitHub Link Button -->
                        <div>
                            <a href="{{ $project->github_url ?? '#' }}" target="_blank" class="inline-flex items-center justify-center px-5 py-2.5 bg-[#BF573F] text-white text-xs font-bold uppercase tracking-wider rounded-lg hover:bg-[#A3432C] transition-all duration-300 shadow-sm group/btn">
                                <span>View Project</span>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-500">Koi project mojood nahi hai.</p>
            @endforelse
        </div>

    </div>
</section>

    <!-- Skills Section -->
    <section id="skills" class="py-24 max-w-6xl mx-auto px-8">
        <div class="mb-16 rot-up">
            <div class="flex items-center space-x-3 mb-3">
                <span class="h-[1px] w-8 bg-[#8B5E34]"></span>
                <span class="text-xs font-semibold uppercase tracking-widest text-[#8B5E34]">Core Competencies</span>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-[#1A1A1A]">Technical Expertise</h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 rot-up">
            <div class="p-6 bg-white rounded-2xl border border-[#E6E0D5] hover:border-[#8B5E34] editorial-card group cursor-pointer">
                <span class="font-bold text-[#1A1A1A] block mb-1 text-base group-hover:text-[#8B5E34] transition-colors">Laravel</span>
                <span class="text-xs text-gray-500 font-light">Backend Framework</span>
            </div>
            <div class="p-6 bg-white rounded-2xl border border-[#E6E0D5] hover:border-[#8B5E34] editorial-card group cursor-pointer">
                <span class="font-bold text-[#1A1A1A] block mb-1 text-base group-hover:text-[#8B5E34] transition-colors">Core PHP</span>
                <span class="text-xs text-gray-500 font-light">Custom Logic</span>
            </div>
            <div class="p-6 bg-white rounded-2xl border border-[#E6E0D5] hover:border-[#8B5E34] editorial-card group cursor-pointer">
                <span class="font-bold text-[#1A1A1A] block mb-1 text-base group-hover:text-[#8B5E34] transition-colors">MySQL</span>
                <span class="text-xs text-gray-500 font-light">Relational Databases</span>
            </div>
            <div class="p-6 bg-white rounded-2xl border border-[#E6E0D5] hover:border-[#8B5E34] editorial-card group cursor-pointer">
                <span class="font-bold text-[#1A1A1A] block mb-1 text-base group-hover:text-[#8B5E34] transition-colors">Tailwind CSS</span>
                <span class="text-xs text-gray-500 font-light">Modern Styling</span>
            </div>
            <div class="p-6 bg-white rounded-2xl border border-[#E6E0D5] hover:border-[#8B5E34] editorial-card group cursor-pointer">
                <span class="font-bold text-[#1A1A1A] block mb-1 text-base group-hover:text-[#8B5E34] transition-colors">JavaScript</span>
                <span class="text-xs text-gray-500 font-light">Dynamic Interactivity</span>
            </div>
            <div class="p-6 bg-white rounded-2xl border border-[#E6E0D5] hover:border-[#8B5E34] editorial-card group cursor-pointer">
                <span class="font-bold text-[#1A1A1A] block mb-1 text-base group-hover:text-[#8B5E34] transition-colors">Bootstrap</span>
                <span class="text-xs text-gray-500 font-light">Responsive Layouts</span>
            </div>
            <div class="p-6 bg-white rounded-2xl border border-[#E6E0D5] hover:border-[#8B5E34] editorial-card group cursor-pointer">
                <span class="font-bold text-[#1A1A1A] block mb-1 text-base group-hover:text-[#8B5E34] transition-colors">HTML5 / CSS3</span>
                <span class="text-xs text-gray-500 font-light">Structural Standards</span>
            </div>
            <div class="p-6 bg-white rounded-2xl border border-[#E6E0D5] hover:border-[#8B5E34] editorial-card group cursor-pointer">
                <span class="font-bold text-[#1A1A1A] block mb-1 text-base group-hover:text-[#8B5E34] transition-colors">Git / GitHub</span>
                <span class="text-xs text-gray-500 font-light">Version Control</span>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="pt-24 bg-white border-t border-[#E6E0D5] relative z-30 pointer-events-auto">
        <div class="max-w-6xl mx-auto px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-start">
                
                <!-- Left Contact Info -->
                <div class="">
                    <div class="flex items-center space-x-3 mb-3">
                        <span class="h-[1px] w-8 bg-[#8B5E34]"></span>
                        <span class="text-xs font-semibold uppercase tracking-widest text-[#8B5E34]">Inquiries & Collaboration</span>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-serif font-bold text-[#1A1A1A] mb-6">
                        Let’s write the next chapter together.
                    </h2>
                    <p class="text-gray-600 leading-relaxed font-light mb-10">
                        I am actively available for web development projects, full-stack implementations, or technical collaborations. Reach out using the form or through direct communication channels.
                    </p>

                    <div class="space-y-6 text-sm">
                        <div class="flex items-center space-x-4 group">
                            <span class="p-3 bg-[#F7F4EF] border border-[#E6E0D5] rounded-xl text-[#8B5E34] group-hover:bg-[#8B5E34] group-hover:text-white transition-all duration-300 flex items-center justify-center">
                                <!-- Mail Icon SVG -->
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                                </svg>
                            </span>
                            <div>
                                <p class="text-xs text-[#8B5E34] font-semibold  uppercase tracking-wider">Direct Mail</p>
                                <a href="mailto:farahmanzoor2336.com" class="font-semibold text-[#1A1A1A] hover:text-[#8B5E34] transition-colors">farahmanzoor2336.com</a>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4 group">
                            <span class="p-3 bg-[#F7F4EF] border border-[#E6E0D5] rounded-xl text-[#8B5E34] group-hover:bg-[#8B5E34] group-hover:text-white transition-all duration-300 flex items-center justify-center">
                                <!-- Location Icon SVG -->
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                                </svg>
                            </span>
                            <div>
                                <p class="text-xs  text-[#8B5E34] font-semibold uppercase tracking-wider">Location</p>
                                <p class="font-semibold text-[#1A1A1A]">Faisalabad, Pakistan</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Contact Form Card -->
                <div class=" mb-20">
                    <div class="bg-[#F7F4EF] p-10 rounded-3xl border border-[#E6E0D5] editorial-card">
                        <!-- Success Message Alert -->
                        <div id="formResponse" class="hidden"></div>
                    <form action="{{ route('contact.store') }}" id="contactForm" class="max-w-xl mx-auto p-6 bg-white rounded-xl shadow-sm" novalidate>
                        @csrf <!-- Laravel CSRF Token -->

                        <!-- Name Field -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none transition-colors border-gray-300"
                                placeholder="Name"
                            >
                            <p id="nameError" class="text-red-500 text-xs mt-1 hidden"></p>
                        </div>

                        <!-- Email Field -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none transition-colors border-gray-300"
                                placeholder="example@gmail.com"
                            >
                            <p id="emailError" class="text-red-500 text-xs mt-1 hidden"></p>
                        </div>

                        <!-- Message Field -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                            <textarea 
                                id="message" 
                                name="message" 
                                rows="4" 
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none transition-colors border-gray-300"
                                placeholder=" Message"
                            ></textarea>
                            <p id="messageError" class="text-red-500 text-xs mt-1 hidden"></p>
                        </div>

                       <button type="submit" id="submitBtn" class="relative overflow-hidden w-full px-6 py-2 bg-[#1A1A1A] text-white rounded-lg text-sm group">
                            <!-- Left se slide hone wala #8B5E34 color -->
                            <span class="absolute top-0 right-0 bottom-0 w-0 bg-[#8B5E34] transition-all duration-500 ease-out group-hover:w-full"></span>
                            
                            <!-- Button ka text -->
                            <span class="relative z-10">Submit</span>
                        </button>
                        
                        <!-- Success/Error Response Message -->
                        <p id="formResponse" class="text-center text-sm mt-3 hidden"></p>
                    </form>

                    <script>
                        document.getElementById('submitBtn').addEventListener('click', function(e) {
                            e.preventDefault();
                            document.getElementById('contactForm').submit();
                        });
                    </script>
                    </div>
                </div> 

            </div>
        </div>
    </section>


    <!-- Footer Section -->
<!-- Balanced & Bold Warm Editorial Footer -->
    <footer class="bg-[#F7F4EF] border-t border-[#E6E0D5] py-16 text-[#1A1A1A]">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
                
                <!-- Column 1: Brand -->
                <div class="space-y-3">
                    <h2 class="text-3xl font-serif font-bold text-[#1A1A1A] tracking-tight">Farah.</h2>
                    <p class="text-xs uppercase tracking-widest text-[#8B5E34] font-bold">Full-Stack Web Developer</p>
                    <p class="text-xs text-[#1A1A1A] font-medium leading-relaxed">
                        Building clean, scalable backend systems & modern web architecture.
                    </p>
                </div>

                <!-- Column 2: Let's Connect & Socials -->
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-widest text-[#8B5E34] mb-4">Let's Connect</h3>
                    <p class="text-[#1A1A1A] text-xs font-medium leading-relaxed mb-5">
                        Open for web development projects and collaborative work.
                    </p>
                    <!-- Icons -->
                    <div class="flex items-center space-x-3">
                        <a href="https://linkedin.com/in/farah-manzoor-3a4730253" target="_blank" title="LinkedIn" class="w-9 h-9 rounded-full bg-white border border-[#E6E0D5] hover:border-[#8B5E34] hover:bg-[#8B5E34] hover:text-white flex items-center justify-center text-[#1A1A1A] transition-all shadow-sm">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                        </a>
                        <a href="https://github.com/farah2336" target="_blank" title="GitHub" class="w-9 h-9 rounded-full bg-white border border-[#E6E0D5] hover:border-[#8B5E34] hover:bg-[#8B5E34] hover:text-white flex items-center justify-center text-[#1A1A1A] transition-all shadow-sm">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                        </a>
                        <a href="https://www.fiverr.com/fatima2336" target="_blank" title="Fiverr" class="w-9 h-9 rounded-full bg-white border border-[#E6E0D5] hover:border-[#8B5E34] hover:bg-[#8B5E34] hover:text-white flex items-center justify-center text-[#1A1A1A] transition-all font-bold text-xs tracking-tighter shadow-sm">
                            fi
                        </a>
                    </div>
                </div>

                <!-- Column 3: Contact Info -->
                <div class="space-y-4">
                    <h3 class="text-xs font-bold uppercase tracking-widest text-[#8B5E34]">Contact Details</h3>
                    <div>
                        <p class="text-[11px] text-[#8B5E34] font-semibold uppercase tracking-wider">Location</p>
                        <p class="text-xs text-[#1A1A1A] font-semibold">Faisalabad, Pakistan</p>
                    </div>
                    <div>
                        <p class="text-[11px] text-[#8B5E34] font-semibold uppercase tracking-wider">Email</p>
                        <a href="mailto:farah@example.com" class="text-xs text-[#1A1A1A] font-semibold hover:text-[#8B5E34] transition-colors">farahmanzoor2336@gmail.com</a>
                    </div>
                    
                </div>

                <!-- Column 4: Navigation -->
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-widest text-[#8B5E34] mb-4">Navigation</h3>
                    <ul class="space-y-2.5 text-xs font-medium">
                        <li><a href="#projects" class="text-[#1A1A1A] hover:text-[#8B5E34] font-semibold transition-colors block">Selected Works</a></li>
                        <li><a href="#skills" class="text-[#1A1A1A] hover:text-[#8B5E34] font-semibold transition-colors block">Tech Stack</a></li>
                        <li><a href="#about" class="text-[#1A1A1A] hover:text-[#8B5E34] font-semibold transition-colors block">About Me</a></li>
                        @php
                            $settings = \App\Models\Setting::latest()->first();
                        @endphp
                            @if(!empty($settings && $settings->resume_path))
                                <a href="{{ asset('storage/' . $settings->resume_path) }}" target="_blank" class="text-[#1A1A1A] hover:text-[#8B5E34] font-semibold transition-colors block">
                                    Resume
                                </a>
                            @else
                                <span class="text-xs text-gray-400 font-medium uppercase tracking-wider">Resume not uploaded</span>
                            @endif
                        <li><a href="#contact" class="text-[#1A1A1A] hover:text-[#8B5E34] font-semibold transition-colors block">Contact Form</a></li>
                    </ul>
                </div>

            </div>

            <!-- Bottom Line (Copyright removed as requested) -->
            
        </div>
    </footer>

    <!-- Precise 3D Scroll Rotation Script -->
    <script>
        (function() {
            document.addEventListener("DOMContentLoaded", function() {
                const observerOptions = {
                    root: null,
                    rootMargin: '0px 0px -100px 0px',
                    threshold: 0.2
                };

                const observer = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('active');
                        }
                    });
                }, observerOptions);

                document.querySelectorAll('.rot-left, .rot-right, .rot-up').forEach(element => {
                    observer.observe(element);
                });
            });
            document.addEventListener("DOMContentLoaded", function() {
                const sections = document.querySelectorAll("section");
                const navLinks = document.querySelectorAll(".nav-link");

                window.addEventListener("scroll", function() {
                    let current = "";
                    
                    sections.forEach(section => {
                        const sectionTop = section.offsetTop;
                        const sectionHeight = section.clientHeight;
                        if (pageYOffset >= (sectionTop - 150)) {
                            current = section.getAttribute("id");
                        }
                    });

                    navLinks.forEach(link => {
                        link.classList.remove("active-nav");
                        if (link.getAttribute("href") === "#" + current) {
                            link.classList.add("active-nav");
                        }
                    });
                });
            });
            // Error correction testing
            document.querySelector('form').addEventListener('submit', function(e) {
                e.preventDefault(); // Page ko freeze ya reload hone se bachane ke liye
                
                let formData = new FormData(this);

                fetch("{{ route('contact.store') }}", {
                    method: "POST",
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => {
                    if (response.ok) {
                        alert('Thank you! Your message has been sent successfully.');
                        location.reload(); // Page reload karke success state dikhane ke liye
                    } else {
                        alert('Something went wrong. Please check your inputs.');
                    }
                })
                .catch(error => console.error('Error:', error));
            });


            
            setTimeout(function() {
                let alertBox = document.getElementById('success-alert');
                if (alertBox) {
                    // Smoothly fade out effect
                    alertBox.style.opacity = '0';
                    setTimeout(function() {
                        alertBox.style.display = 'none';
                    }, 500); // 0.5 seconds fade duration ke baad completely remove ho jaye ga
                }
            }, 8000); // 4000 milliseconds = 4 seconds baad message khatam ho jaye ga
        
        
        
            // Ajax validation for contact form

            
                const form = document.getElementById('contactForm');
                const nameInput = document.getElementById('name');
                const emailInput = document.getElementById('email');
                const messageInput = document.getElementById('message');

                const nameError = document.getElementById('nameError');
                const emailError = document.getElementById('emailError');
                const messageError = document.getElementById('messageError');
                const formResponse = document.getElementById('formResponse');

                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                function showError(input, errorElement, message) {
                    input.classList.remove('border-gray-300', 'border-green-500');
                    input.classList.add('border-red-500');
                    errorElement.textContent = message;
                    errorElement.classList.remove('hidden');
                }

                function clearError(input, errorElement) {
                    input.classList.remove('border-red-500');
                    errorElement.textContent = '';
                    errorElement.classList.add('hidden');
                }

                function validateName() {
                    if (nameInput.value.trim() === '') {
                        showError(nameInput, nameError, 'Please enter your name.');
                        return false;
                    }
                    clearError(nameInput, nameError);
                    return true;
                }

                function validateEmail() {
                    const val = emailInput.value.trim();
                    if (val === '') {
                        showError(emailInput, emailError, 'Please enter a valid email.');
                        return false;
                    } else if (!emailRegex.test(val)) {
                        showError(emailInput, emailError, 'Please enter a valid email. (e.g: example@gmail.com ).');
                        return false;
                    }
                    clearError(emailInput, emailError);
                    return true;
                }

                function validateMessage() {
                    if (messageInput.value.trim() === '') {
                        showError(messageInput, messageError, 'Please write your message.');
                        return false;
                    }
                    clearError(messageInput, messageError);
                    return true;
                }

                // Real-time blur validation
                nameInput.addEventListener('blur', validateName);
                emailInput.addEventListener('blur', validateEmail);
                messageInput.addEventListener('blur', validateMessage);

                // Form Submit Handler
                const submitBtn = document.getElementById('submitBtn');
                submitBtn.addEventListener('click', async (e) => {
                        e.preventDefault();
                    // Check all fields before submitting
                    const isNameValid = validateName();
                    const isEmailValid = validateEmail();
                    const isMessageValid = validateMessage();

                    if (isNameValid && isEmailValid && isMessageValid) {
                        // FormData collect karein
                        const formData = new FormData(form);

                        try {
                            // Laravel route par AJAX request bhejein (apne route ka naam yahan likhein)
                            let response = await fetch('{{ route("contact.store") }}', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('#contactForm input[name="_token"]').value,
                                    'Accept': 'application/json'
                                },
                                body: formData
                            });

                            let result = await response.json();

                            if (response.ok && result.success) {
                                formResponse.textContent = result.success;
                                formResponse.className = 'mb-4 p-4 rounded-lg text-sm border bg-emerald-50 border-emerald-200 text-emerald-800';
                                formResponse.classList.remove('hidden');
                                form.reset();
                                // Borders reset karein
                                [nameInput, emailInput, messageInput].forEach(inp => inp.classList.remove('border-green-500', 'border-red-500'));
                            } else {
                                formResponse.textContent = 'Kuch ghalat ho gaya, dobara koshish karein.';
                                formResponse.className = 'mb-4 p-4 rounded-lg text-sm border bg-red-50 border-red-200 text-red-800';
                                formResponse.classList.remove('hidden');
                            }
                        } catch (error) {
                            console.error('Error:', error);
                            formResponse.textContent = 'Connection Error: ' + error.message;
                            formResponse.className = 'text-center text-sm mt-3 text-red-600';
                            formResponse.classList.remove('hidden');
                        }
                    }
                    else {
                        // --- AGAR KOI BHI FIELD KHALI YA GHALAT HO ---
                        formResponse.textContent = 'Please fill all required fields.';
                        formResponse.className = 'mb-4 p-4 rounded-lg text-sm border bg-red-50 border-red-200 text-red-800';
                        formResponse.classList.remove('hidden');
                    }
                });
        

        })();
    
    </script>

</body>
</html>