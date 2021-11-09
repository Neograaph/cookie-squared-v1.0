import unittest
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import json
import csv
import pickle
from time import sleep

class PythonOrgSearch(unittest.TestCase):

    def setUp(self):

        self.driver = webdriver.Firefox(executable_path=r'geckodriver.exe')
        self.url = "https://www.scrapingbee.com/"
        self.driver.get(self.url)

    def test_search_in_python_org(self):
        driver = self.driver

        pages = []
        pages.append(self.url)

        with open('data.json', 'w') as json_file:
            json.dump(driver.get_cookies(), json_file)  

        for page in pages:
            driver.get(page)
            links_tab = driver.find_elements(By.TAG_NAME, 'a')
            links = [elem.get_attribute('href') for elem in links_tab]
          
            for link in links:
                if link:
                    if link.startswith(self.url):
                        if '#' not in link and '.jpg' not in link and '.pdf' not in link and '.zip' not in link and '.png' not in link:
                            if link not in pages:
                                pages.append(link)


            cookies = driver.get_cookies()

            listObj = []

            for cookie in cookies:
                print(cookie['name'])
                if cookie['name'] in listObj:
                    listObj.remove(cookie)
                else:
                    listObj.append(cookie)
        
        with open('data.json', 'w') as json_file:
            json.dump(listObj, json_file, indent=4, separators=(',',': '))  

        print('REUSSI')
        print(listObj)
        driver.close()

if __name__ == "__main__":
    unittest.main()
