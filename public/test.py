from selenium import webdriver
from selenium.webdriver.common.by import By
import json
import sys

driver = webdriver.Firefox(executable_path=r'geckodriver.exe')
url = sys.argv[1]
driver.get(url)

pages = []
pages.append(url)

with open('data.json', 'w') as json_file:
    json.dump(driver.get_cookies(), json_file)

for page in pages:
    driver.get(page)
    links_tab = driver.find_elements(By.TAG_NAME, 'a')
    links = [elem.get_attribute('href') for elem in links_tab]

    for link in links:
        if link:
            if link.startswith(url):
                if '#' not in link and '.jpg' not in link and '.pdf' not in link and '.zip' not in link and '.png' not in link:
                    if link not in pages:
                        pages.append(link)

cookies = driver.get_cookies()

listObj = []

for cookie in cookies:

    if cookie['name'] in listObj:
        listObj.remove(cookie)
    else:
        listObj.append(cookie)
with open('data.json', 'w') as json_file:
    json.dump(listObj, json_file, indent=4, separators=(',', ': '))
print(listObj)
driver.close()
