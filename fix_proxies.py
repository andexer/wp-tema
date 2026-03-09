import os
import re

directory = '/home/andexer/Documentos/docker/wp-content/themes/detodo24/resources/views/woocommerce'
pattern = re.compile(r"echo view\('([^']+)'\)->render\(\);")
replacement = r"echo view('\1', get_defined_vars())->render();"

count = 0

for root, _, files in os.walk(directory):
    for filename in files:
        if filename.endswith(".php") and not filename.endswith(".blade.php"):
            filepath = os.path.join(root, filename)
            with open(filepath, 'r') as file:
                content = file.read()
            
            if "echo view(" in content and "get_defined_vars()" not in content:
                new_content = pattern.sub(replacement, content)
                
                if new_content != content:
                    with open(filepath, 'w') as file:
                        file.write(new_content)
                    count += 1
                    print(f"Updated: {filepath}")

print(f"Total files updated: {count}")
