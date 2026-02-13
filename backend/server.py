import http.server
import socketserver
import os
import sys

PORT = 3000

# Set the working directory to the frontend folder
FRONTEND_DIR = os.path.join(os.path.dirname(__file__), '../frontend')
os.chdir(FRONTEND_DIR)

class CustomHandler(http.server.SimpleHTTPRequestHandler):
    def do_GET(self):
        # Remove query params for file checking
        path = self.path.split('?')[0]
        
        # If it is a directory, let standard handler deal with it (index.html)
        if path.endswith('/'):
            super().do_GET()
            return
            
        # Check if file exists as is
        location = os.getcwd() + path
        if os.path.exists(location):
            super().do_GET()
            return
            
        # Check if adding .html helps
        if os.path.exists(location + '.html'):
            self.path = self.path.replace(path, path + '.html')
            super().do_GET()
            return
            
        # Default behavior (404 etc)
        super().do_GET()

Handler = CustomHandler

try:
    with socketserver.TCPServer(("", PORT), Handler) as httpd:
        print(f"Serving at port {PORT}")
        print(f"Serving content from {os.getcwd()}")
        print("Support for extensionless URLs enabled.")
        httpd.serve_forever()
except OSError:
    print(f"Port {PORT} is busy. Trying {PORT+1}...")
    with socketserver.TCPServer(("", PORT+1), Handler) as httpd:
        print(f"Serving at port {PORT+1}")
        print(f"Serving content from {os.getcwd()}")
        print("Support for extensionless URLs enabled.")
        httpd.serve_forever()
