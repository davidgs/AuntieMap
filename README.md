# Auntie MAP Recovery Store WordPress Theme

A beautiful, compassionate WordPress theme designed specifically for selling AA Recovery-related merchandise and supporting the recovery community.

## Features

### 🎨 Design & Aesthetics
- **Purple Color Scheme**: Calming purple gradient design promoting healing and tranquility
- **Recovery-Focused**: Every element designed with the recovery community in mind
- **Responsive Design**: Looks beautiful on all devices and screen sizes
- **Accessibility**: Built with accessibility standards in mind

### 🛒 E-Commerce Ready
- **WooCommerce Integration**: Full support for online store functionality
- **Custom Product Templates**: Specialized templates for recovery merchandise
- **Recovery Impact Messaging**: Shows how purchases support the community
- **Cart Enhancements**: Recovery-themed cart and checkout experience

### 💜 Recovery-Specific Features
- **Daily Affirmations**: Rotating inspirational messages for visitors
- **Recovery Stories**: Custom post type for sharing recovery journeys
- **Milestone Calculator**: Interactive tool for calculating sobriety milestones
- **Crisis Support Integration**: Easy access to emergency resources
- **Meeting Finder Links**: Direct integration with AA/NA meeting finders

### 🔧 Technical Features
- **WordPress 6.4+ Compatible**: Built for the latest WordPress versions
- **PHP 7.4+ Required**: Modern PHP standards
- **SEO Optimized**: Built-in schema markup and SEO best practices
- **Performance Optimized**: Fast loading with optimized code
- **Security Focused**: Following WordPress security best practices

## Installation

1. **Download the theme** files to your WordPress themes directory:
   ```
   /wp-content/themes/auntie-map/
   ```

2. **Activate the theme** in your WordPress admin:
   - Go to Appearance > Themes
   - Find "Auntie MAP Recovery Store"
   - Click "Activate"

3. **Install required plugins**:
   - WooCommerce (for e-commerce functionality)
   - Contact Form 7 (recommended for contact forms)

4. **Import sample content** (optional):
   - Recovery stories and sample products are available for import

## Setup Guide

### Initial Configuration

1. **Set up WooCommerce**:
   - Follow the WooCommerce setup wizard
   - Configure payment methods
   - Set up shipping options

2. **Customize theme settings**:
   - Go to Appearance > Customize
   - Configure the "Recovery Support" section
   - Add your support phone number
   - Set meeting finder URL

3. **Create essential pages**:
   - About page
   - Contact page
   - Privacy Policy
   - Terms of Service

### Recommended Plugins

- **WooCommerce**: Essential for store functionality
- **Contact Form 7**: For contact and support forms
- **Yoast SEO**: Additional SEO optimization
- **UpdraftPlus**: Backup solution
- **Wordfence**: Security enhancement

## Customization

### Color Scheme
The theme uses CSS custom properties for easy color customization:

```css
:root {
    --primary-purple: #6B46C1;
    --secondary-purple: #8B5CF6;
    --light-purple: #EDE9FE;
    --dark-purple: #4C1D95;
    --accent-purple: #A78BFA;
}
```

### Recovery Features

#### Daily Affirmations
Add custom affirmations by modifying the `auntie_map_get_daily_affirmation()` function in `functions.php`.

#### Recovery Stories
Create recovery stories using the custom post type:
1. Go to Recovery Stories > Add New
2. Write the story content
3. Add featured image
4. Set recovery start date for milestone calculation

#### Emergency Support
The theme includes built-in crisis support features:
- Rapid click detection for distressed users
- Emergency resource modal
- Crisis hotline integration

## Content Guidelines

### Recovery Stories
- Always get permission before sharing stories
- Respect privacy and anonymity
- Include appropriate disclaimers
- Focus on hope and recovery

### Product Descriptions
- Emphasize community support
- Include recovery messaging
- Highlight how purchases help others
- Use inclusive, supportive language

### General Content
- Maintain a supportive, non-judgmental tone
- Include appropriate crisis resources
- Respect AA/NA traditions and anonymity
- Focus on hope and recovery

## Support Resources Integration

The theme includes built-in integration with:
- **988 Suicide & Crisis Lifeline**
- **SAMHSA National Helpline**
- **AA Meeting Finder**
- **NA Meeting Search**
- **Crisis Text Line**

## Accessibility Features

- **Screen Reader Support**: Proper ARIA labels and semantic HTML
- **Keyboard Navigation**: Full keyboard accessibility
- **Color Contrast**: WCAG AA compliant color ratios
- **Focus Management**: Clear focus indicators
- **Alternative Text**: Image alt text support

## Performance Optimization

- **Lazy Loading**: Images load as needed
- **Minified Assets**: Optimized CSS and JavaScript
- **Caching Friendly**: Compatible with caching plugins
- **Optimized Images**: Responsive image support
- **Clean Code**: Efficient, well-structured code

## Security Features

- **Input Sanitization**: All user inputs properly sanitized
- **Nonce Verification**: CSRF protection on forms
- **Capability Checks**: Proper user permission checks
- **Secure Coding**: Following WordPress security standards

## Browser Support

- **Modern Browsers**: Chrome, Firefox, Safari, Edge
- **Mobile Browsers**: iOS Safari, Chrome Mobile
- **Progressive Enhancement**: Graceful degradation for older browsers

## License

This theme is licensed under the GPL v2 or later.

## Support

For theme support and customization:
- **Documentation**: Included in theme files
- **Community**: WordPress.org forums
- **Professional Support**: Available for custom modifications

## Contributing

We welcome contributions that improve the theme's support for the recovery community:
- Bug fixes and improvements
- Accessibility enhancements
- New recovery-focused features
- Translation contributions

## Changelog

### Version 1.0.0
- Initial release
- Full WooCommerce integration
- Recovery stories custom post type
- Daily affirmations system
- Crisis support features
- Responsive design
- Accessibility features

## Credits

- **Design Inspiration**: Recovery community feedback and needs
- **Icons**: Custom SVG icons and emoji
- **Fonts**: Inter font family from Google Fonts
- **Color Psychology**: Purple chosen for its calming, healing properties

## Important Notes

### Recovery Community Respect
This theme is designed to support, not replace, professional recovery programs. Always encourage users to:
- Seek professional help when needed
- Attend meetings and work with sponsors
- Contact crisis resources in emergencies
- Respect anonymity and privacy

### Legal Considerations
- Include appropriate disclaimers
- Respect AA/NA traditions
- Maintain user privacy
- Follow local regulations for e-commerce

---

**Remember**: Recovery is a journey, not a destination. This theme is designed to support that journey with compassion, hope, and community. 💜
