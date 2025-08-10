/**
 * Auntie MAP Recovery Store Theme JavaScript
 *
 * @package AuntieMap
 * @since 1.0.0
 */

jQuery(document).ready(function ($) {
  "use strict";

  // Mobile menu toggle
  $(".mobile-menu-toggle").on("click", function () {
    const $navigation = $(".main-navigation");
    const isExpanded = $(this).attr("aria-expanded") === "true";

    $(this).attr("aria-expanded", !isExpanded);
    $navigation.toggleClass("active");

    // Toggle hamburger to X animation
    $(this).toggleClass("menu-open");
  });

  // Smooth scroll for anchor links
  $('a[href^="#"]').on("click", function (e) {
    const target = $(this.getAttribute("href"));
    if (target.length) {
      e.preventDefault();
      $("html, body")
        .stop()
        .animate(
          {
            scrollTop: target.offset().top - 100,
          },
          1000
        );
    }
  });

  // Recovery milestone calculator
  if ($(".milestone-calculator").length) {
    $(".milestone-calculator form").on("submit", function (e) {
      e.preventDefault();

      const startDate = new Date($("#sobriety-date").val());
      const today = new Date();
      const diffTime = Math.abs(today - startDate);
      const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

      displayMilestone(diffDays);
    });
  }

  function displayMilestone(days) {
    const $result = $(".milestone-result");
    const message = getMilestoneMessage(days);

    $result
      .html(
        `
            <div class="milestone-display">
                <div class="milestone-number">${days}</div>
                <div class="milestone-label">${
                  days === 1 ? "Day" : "Days"
                } Sober</div>
                <div class="milestone-message">${message}</div>
                <div class="milestone-celebration">🎉 You're doing amazing! 🎉</div>
            </div>
        `
      )
      .fadeIn();

    // Add confetti effect for major milestones
    if (isMajorMilestone(days)) {
      createConfetti();
    }
  }

  function getMilestoneMessage(days) {
    const milestones = {
      1: "One day at a time - You've got this!",
      7: "One week strong - Keep going!",
      30: "One month of courage - Amazing progress!",
      90: "Three months of strength - You're inspiring!",
      180: "Six months of growth - Incredible journey!",
      365: "One year of recovery - You are a warrior!",
      730: "Two years of transformation - Unstoppable!",
      1095: "Three years of resilience - You're an inspiration!",
    };

    let message = "Every day is a victory!";
    for (const milestone in milestones) {
      if (days >= milestone) {
        message = milestones[milestone];
      }
    }

    return message;
  }

  function isMajorMilestone(days) {
    const majorMilestones = [1, 7, 30, 90, 180, 365, 730, 1095];
    return majorMilestones.includes(days);
  }

  function createConfetti() {
    // Simple confetti effect
    for (let i = 0; i < 50; i++) {
      const confetti = $('<div class="confetti"></div>');
      confetti.css({
        position: "fixed",
        left: Math.random() * 100 + "%",
        top: "-10px",
        width: "10px",
        height: "10px",
        backgroundColor: ["#6B46C1", "#8B5CF6", "#A78BFA", "#EDE9FE"][
          Math.floor(Math.random() * 4)
        ],
        borderRadius: "50%",
        zIndex: 9999,
        pointerEvents: "none",
      });

      $("body").append(confetti);

      confetti.animate(
        {
          top: $(window).height() + "px",
          left: Math.random() * 100 + "%",
        },
        3000,
        function () {
          $(this).remove();
        }
      );
    }
  }

  // Emergency support modal
  let rapidClickCount = 0;
  let clickTimer;

  $(document).on("click", function () {
    rapidClickCount++;
    clearTimeout(clickTimer);

    clickTimer = setTimeout(function () {
      if (rapidClickCount > 15) {
        showEmergencyModal();
      }
      rapidClickCount = 0;
    }, 3000);
  });

  function showEmergencyModal() {
    const modal = $("#emergency-support-modal");
    if (modal.length) {
      modal.fadeIn();
    } else {
      createEmergencyModal();
    }
  }

  function createEmergencyModal() {
    const modalHTML = `
            <div id="emergency-support-modal" class="emergency-modal">
                <div class="modal-content">
                    <span class="modal-close">&times;</span>
                    <h3>Emergency Support Resources</h3>
                    <div class="emergency-resources">
                        <p><strong>Crisis Support:</strong></p>
                        <ul>
                            <li><a href="tel:988">988 - Suicide & Crisis Lifeline</a></li>
                            <li><a href="tel:1-800-662-4357">SAMHSA National Helpline: 1-800-662-4357</a></li>
                            <li><a href="sms:741741">Crisis Text Line: Text HOME to 741741</a></li>
                        </ul>
                        <p><em>You are not alone. Help is available 24/7.</em></p>
                        <div class="modal-affirmation">
                            <p><strong>Remember:</strong> "${auntie_map_get_daily_affirmation()}"</p>
                        </div>
                    </div>
                </div>
            </div>
        `;

    $("body").append(modalHTML);
    $("#emergency-support-modal").fadeIn();
  }

  // Close emergency modal
  $(document).on("click", ".modal-close, .emergency-modal", function (e) {
    if (e.target === this) {
      $(".emergency-modal").fadeOut();
    }
  });

  // Newsletter signup
  $("#newsletter-form").on("submit", function (e) {
    e.preventDefault();

    const email = $(this).find('input[name="email"]').val();
    const $button = $(this).find('button[type="submit"]');
    const originalText = $button.text();

    $button.text("Subscribing...").prop("disabled", true);

    // Simulate newsletter signup (replace with actual implementation)
    setTimeout(function () {
      $button.text("Subscribed! 💜").css("background-color", "#10B981");

      // Show thank you message
      const thankYou = $(`
                <div class="newsletter-thank-you">
                    <p>Thank you for subscribing! You'll receive daily affirmations and recovery support.</p>
                </div>
            `);

      $("#newsletter-form").after(thankYou);

      setTimeout(function () {
        $button
          .text(originalText)
          .prop("disabled", false)
          .css("background-color", "");
        $(".newsletter-thank-you").fadeOut();
      }, 3000);
    }, 1500);
  });

  // WooCommerce cart updates
  if (typeof wc_add_to_cart_params !== "undefined") {
    $(document.body).on(
      "added_to_cart",
      function (event, fragments, cart_hash, $button) {
        // Show success message with recovery theme
        showCartSuccessMessage();
      }
    );
  }

  function showCartSuccessMessage() {
    const message = $(`
            <div class="cart-success-message">
                <div class="success-content">
                    <span class="success-icon">💜</span>
                    <span class="success-text">Added to cart! Your purchase supports recovery communities.</span>
                </div>
            </div>
        `);

    $("body").append(message);

    setTimeout(function () {
      message.addClass("show");
    }, 100);

    setTimeout(function () {
      message.removeClass("show");
      setTimeout(function () {
        message.remove();
      }, 300);
    }, 3000);
  }

  // Accessibility improvements

  // Skip link functionality
  $(".skip-link").on("click", function (e) {
    const target = $($(this).attr("href"));
    if (target.length) {
      target.focus();
    }
  });

  // Keyboard navigation for custom elements
  $(".feature-card, .product-card, .story-card").on("keydown", function (e) {
    if (e.which === 13 || e.which === 32) {
      // Enter or Space
      const link = $(this).find("a").first();
      if (link.length) {
        link[0].click();
      }
    }
  });

  // Focus management for modals
  $(document).on("keydown", function (e) {
    if (e.which === 27) {
      // Escape key
      $(".emergency-modal:visible").fadeOut();
    }
  });

  // Lazy loading for images
  if ("IntersectionObserver" in window) {
    const imageObserver = new IntersectionObserver((entries, observer) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          const img = entry.target;
          img.src = img.dataset.src;
          img.classList.remove("lazy");
          imageObserver.unobserve(img);
        }
      });
    });

    document.querySelectorAll("img[data-src]").forEach((img) => {
      imageObserver.observe(img);
    });
  }

  // Scroll-triggered animations
  $(window).on("scroll", function () {
    $(".animate-on-scroll").each(function () {
      const elementTop = $(this).offset().top;
      const elementBottom = elementTop + $(this).outerHeight();
      const viewportTop = $(window).scrollTop();
      const viewportBottom = viewportTop + $(window).height();

      if (elementBottom > viewportTop && elementTop < viewportBottom) {
        $(this).addClass("animated");
      }
    });
  });

  // Recovery quote rotator
  if ($(".recovery-quotes").length) {
    const quotes = [
      "Progress, not perfection.",
      "One day at a time.",
      "You are stronger than your addiction.",
      "Recovery is a journey, not a destination.",
      "Courage doesn't mean you're not scared.",
      "Today I choose recovery.",
      "I am worthy of love and happiness.",
      "Every day is a new beginning.",
    ];

    let currentQuote = 0;
    const $quotesContainer = $(".recovery-quotes");

    function rotateQuote() {
      $quotesContainer.fadeOut(500, function () {
        $(this).text(quotes[currentQuote]).fadeIn(500);
        currentQuote = (currentQuote + 1) % quotes.length;
      });
    }

    // Rotate quotes every 5 seconds
    setInterval(rotateQuote, 5000);
  }

  // Form validation enhancements
  $("form").on("submit", function (e) {
    const $form = $(this);
    let isValid = true;

    // Check required fields
    $form.find("[required]").each(function () {
      const $field = $(this);
      if (!$field.val().trim()) {
        isValid = false;
        $field.addClass("error");

        // Add error message if not exists
        if (!$field.next(".error-message").length) {
          $field.after(
            '<span class="error-message">This field is required</span>'
          );
        }
      } else {
        $field.removeClass("error");
        $field.next(".error-message").remove();
      }
    });

    // Email validation
    $form.find('input[type="email"]').each(function () {
      const $field = $(this);
      const email = $field.val();
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

      if (email && !emailRegex.test(email)) {
        isValid = false;
        $field.addClass("error");

        if (!$field.next(".error-message").length) {
          $field.after(
            '<span class="error-message">Please enter a valid email address</span>'
          );
        }
      }
    });

    if (!isValid) {
      e.preventDefault();
    }
  });

  // Remove error styling on input
  $("input, textarea, select").on("input change", function () {
    $(this).removeClass("error");
    $(this).next(".error-message").remove();
  });
});

// CSS for JavaScript-generated elements
const dynamicStyles = `
<style>
.confetti {
    animation: fall 3s linear forwards;
}

@keyframes fall {
    0% {
        transform: translateY(-100vh) rotate(0deg);
    }
    100% {
        transform: translateY(100vh) rotate(360deg);
    }
}

.emergency-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10000;
}

.modal-content {
    background: white;
    padding: 2rem;
    border-radius: 1rem;
    max-width: 500px;
    width: 90%;
    position: relative;
}

.modal-close {
    position: absolute;
    top: 1rem;
    right: 1rem;
    font-size: 2rem;
    cursor: pointer;
    color: #6B7280;
}

.modal-close:hover {
    color: #374151;
}

.modal-affirmation {
    background: #EDE9FE;
    padding: 1rem;
    border-radius: 0.5rem;
    margin-top: 1rem;
    border-left: 4px solid #6B46C1;
}

.cart-success-message {
    position: fixed;
    top: 20px;
    right: 20px;
    background: #10B981;
    color: white;
    padding: 1rem 1.5rem;
    border-radius: 0.5rem;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    transform: translateX(100%);
    transition: transform 0.3s ease;
    z-index: 9999;
}

.cart-success-message.show {
    transform: translateX(0);
}

.success-content {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.newsletter-thank-you {
    background: #10B981;
    color: white;
    padding: 1rem;
    border-radius: 0.5rem;
    margin-top: 1rem;
    text-align: center;
}

.error {
    border-color: #EF4444 !important;
}

.error-message {
    color: #EF4444;
    font-size: 0.875rem;
    margin-top: 0.25rem;
    display: block;
}

.animate-on-scroll {
    opacity: 0;
    transform: translateY(30px);
    transition: all 0.6s ease;
}

.animate-on-scroll.animated {
    opacity: 1;
    transform: translateY(0);
}

.milestone-display {
    text-align: center;
    padding: 2rem;
    background: linear-gradient(135deg, #6B46C1, #8B5CF6);
    color: white;
    border-radius: 1rem;
    margin-top: 2rem;
}

.milestone-number {
    font-size: 4rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.milestone-label {
    font-size: 1.5rem;
    margin-bottom: 1rem;
}

.milestone-message {
    font-size: 1.25rem;
    margin-bottom: 1rem;
    font-style: italic;
}

.milestone-celebration {
    font-size: 1.5rem;
}
</style>
`;

// Inject dynamic styles
document.head.insertAdjacentHTML("beforeend", dynamicStyles);
