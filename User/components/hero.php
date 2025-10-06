<?php
include "./Backends/HeroSection.php";
?>

<section class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-10 px-6 py-16 sm:py-24 items-center">
    
    <div class="text-center md:text-left">
        <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold mb-4">
            Hello, I'm
            <span class="bg-clip-text text-transparent bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500">
                <?php echo htmlspecialchars($full_name, ENT_QUOTES, 'UTF-8'); ?>
            </span>
        </h2>

        <h3 class="text-xl sm:text-2xl md:text-3xl font-bold mb-4 bg-clip-text text-transparent bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500">
            <span id="typing"
                  data-titles='<?php echo json_encode($titles, JSON_UNESCAPED_UNICODE); ?>'></span>
            <span class="typing-cursor">|</span>
        </h3>

        <p class="text-base sm:text-lg mb-6 leading-relaxed text-justify sm:text-left">
            <?php echo nl2br(htmlspecialchars($bio, ENT_QUOTES, 'UTF-8')); ?>
        </p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start flex-wrap">
            <a href="#projects"
               class="px-6 py-3 rounded-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white hover:shadow-lg hover:scale-105 transition-all duration-300 text-center">
               View Projects
            </a>

            <?php if (!empty($cv_link)): ?>
                <a href="<?php echo htmlspecialchars($cv_link, ENT_QUOTES, 'UTF-8'); ?>" target="_blank"
                   class="px-6 py-3 rounded-full border-2 border-indigo-600 text-indigo-600 hover:bg-indigo-600 hover:text-white transition-all duration-300 flex items-center gap-2 justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M7.5 10.5 12 15m0 0 4.5-4.5M12 15V3" />
                    </svg>
                    Download CV
                </a>
            <?php endif; ?>
        </div>
    </div>

    <div class="flex justify-center mt-10 md:mt-0">
        <div class="relative w-64 sm:w-72 md:w-80 h-64 sm:h-72 md:h-80">
            <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-pink-500 rounded-full blur-xl opacity-30 animate-pulse"></div>
            <img src="<?php echo htmlspecialchars($profile_image, ENT_QUOTES, 'UTF-8'); ?>"
                 alt="<?php echo htmlspecialchars($full_name, ENT_QUOTES, 'UTF-8'); ?>"
                 class="relative h-full w-full object-cover hover:scale-105 transition-transform duration-500 rounded-full border-4 border-white dark:border-gray-700 shadow-2xl"
                 id="heroImage"
                 data-light-img="<?php echo htmlspecialchars($profile_image, ENT_QUOTES, 'UTF-8'); ?>"
                 data-dark-img="./assets/DarkChange.jpg" 
            >
        </div>
    </div>

</section>
