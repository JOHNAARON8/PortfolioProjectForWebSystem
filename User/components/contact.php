<?php include "./Backends/ContactSection.php"; ?>

<section id="contact" class="max-w-7xl mx-auto px-6 py-20 bg-gray-50 dark:bg-gray-900">
  <div class="text-center mb-16">
    <h3 class="text-4xl font-extrabold mb-4 bg-gradient-to-r from-indigo-500 to-purple-500 bg-clip-text text-transparent">
      Get In Touch
    </h3>
    <div class="w-24 h-1 bg-gradient-to-r from-indigo-500 to-purple-500 mx-auto rounded"></div>
    <p class="text-gray-600 dark:text-gray-300 mt-6 max-w-3xl mx-auto text-lg">
      Have a project in mind or want to collaborate? I'd love to hear from you. Let's create something amazing together!
    </p>
  </div>

  <div class="grid md:grid-cols-2 gap-12">
    <!-- Contact Info -->
    <div class="space-y-8 p-6 bg-white dark:bg-gray-800 rounded-xl shadow-lg">
      <h4 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Let's Connect</h4>
      <div class="space-y-6">
        <!-- Email -->
        <div class="flex items-center gap-4">
          <div class="p-4 bg-indigo-100 dark:bg-indigo-900/30 rounded-xl">
            <i data-feather="mail" class="text-indigo-600"></i>
          </div>
          <div>
            <div class="font-medium text-gray-700 dark:text-gray-200">Email</div>
            <div class="text-gray-600 dark:text-gray-400"><?= htmlspecialchars($contact['email'] ?? 'your@email.com'); ?></div>
          </div>
        </div>
        <!-- Phone -->
        <div class="flex items-center gap-4">
          <div class="p-4 bg-purple-100 dark:bg-purple-900/30 rounded-xl">
            <i data-feather="phone" class="text-purple-600"></i>
          </div>
          <div>
            <div class="font-medium text-gray-700 dark:text-gray-200">Phone</div>
            <div class="text-gray-600 dark:text-gray-400"><?= htmlspecialchars($contact['phone'] ?? '+00 000 0000'); ?></div>
          </div>
        </div>
        <!-- Location -->
        <div class="flex items-center gap-4">
          <div class="p-4 bg-pink-100 dark:bg-pink-900/30 rounded-xl">
            <i data-feather="map-pin" class="text-pink-600"></i>
          </div>
          <div>
            <div class="font-medium text-gray-700 dark:text-gray-200">Location</div>
            <div class="text-gray-600 dark:text-gray-400"><?= htmlspecialchars($contact['location'] ?? 'Your Location'); ?></div>
          </div>
        </div>
      </div>

      <!-- Social Links -->
      <div class="flex items-center gap-4 mt-6">
        <?php if (!empty($contact['github_link'])): ?>
          <a href="<?= htmlspecialchars($contact['github_link']); ?>" target="_blank" class="p-3 bg-gray-100 dark:bg-gray-700 rounded-xl hover:bg-gray-200 dark:hover:bg-gray-600 transition">
            <i data-feather="github" class="text-gray-800 dark:text-gray-100"></i>
          </a>
        <?php endif; ?>
        <?php if (!empty($contact['linkedin_link'])): ?>
          <a href="<?= htmlspecialchars($contact['linkedin_link']); ?>" target="_blank" class="p-3 bg-gray-100 dark:bg-gray-700 rounded-xl hover:bg-gray-200 dark:hover:bg-gray-600 transition">
            <i data-feather="linkedin" class="text-blue-600"></i>
          </a>
        <?php endif; ?>
        <?php if (!empty($contact['facebook_link'])): ?>
          <a href="<?= htmlspecialchars($contact['facebook_link']); ?>" target="_blank" class="p-3 bg-gray-100 dark:bg-gray-700 rounded-xl hover:bg-gray-200 dark:hover:bg-gray-600 transition">
            <i data-feather="facebook" class="text-blue-800"></i>
          </a>
        <?php endif; ?>
      </div>
    </div>

    <!-- Contact Form -->
    <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow-lg">
 
      <div id="form-status" class="hidden mb-6 p-4 rounded-lg"></div>

      <form id="contactForm" class="space-y-5">
        <div>
          <label for="user_name" class="block text-gray-700 dark:text-gray-200 mb-2 font-medium">Name</label>
          <input type="text" name="user_name" id="user_name" placeholder="Your Name" required
            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600 transition">
        </div>

        <div>
          <label for="user_email" class="block text-gray-700 dark:text-gray-200 mb-2 font-medium">Email</label>
          <input type="email" name="user_email" id="user_email" placeholder="your.email@example.com" required
            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600 transition">
        </div>

        <div>
          <label for="subject" class="block text-gray-700 dark:text-gray-200 mb-2 font-medium">Subject</label>
          <input type="text" name="subject" id="subject" placeholder="What's this about?" required
            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600 transition">
        </div>

        <div>
          <label for="message" class="block text-gray-700 dark:text-gray-200 mb-2 font-medium">Message</label>
          <textarea name="message" id="message" rows="5" placeholder="Your message here..." required
            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600 transition"></textarea>
        </div>

        <button type="submit" class="w-full py-3 px-6 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-lg hover:scale-105 hover:shadow-lg transition-transform">
          Send Message
        </button>
      </form>
    </div>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/emailjs-com@3/dist/email.min.js"></script>
<script>
  emailjs.init('SwgFNrEUk_yrWe59u');

  const contactForm = document.getElementById('contactForm');
  const formStatus = document.getElementById('form-status');

  contactForm.addEventListener('submit', function(e) {
    e.preventDefault();
    formStatus.classList.add('hidden');
    formStatus.textContent = '';

    const timeInput = document.createElement('input');
    timeInput.type = 'hidden';
    timeInput.name = 'time';
    timeInput.value = new Date().toLocaleString();
    contactForm.appendChild(timeInput);

    const templateParams = {
      user_name: contactForm.user_name.value,
      user_email: contactForm.user_email.value,
      subject: contactForm.subject.value,
      message: contactForm.message.value,
      time: timeInput.value
    };

    emailjs.send('service_w6z1rw7', 'template_aw4jdbq', templateParams)
      .then(() => {
        formStatus.textContent = 'Message sent successfully! I will get back to you soon.';
        formStatus.className = 'mb-6 p-4 rounded-lg bg-green-600 text-white';
        formStatus.classList.remove('hidden');
        contactForm.reset();
        timeInput.remove();
      })
      .catch((error) => {
        console.error('EmailJS error:', error);
        formStatus.textContent = 'Failed to send message. Please try again.';
        formStatus.className = 'mb-6 p-4 rounded-lg bg-red-600 text-white';
        formStatus.classList.remove('hidden');
        timeInput.remove();
      });
  });
</script>
