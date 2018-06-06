import unittest, time
from selenium import webdriver

class MeichuWebTesting(unittest.TestCase): # inherit unittest
	def setUp(self): # execute before each test
		self.driver = webdriver.Chrome()

	def testcase_1(self): # testcase start with test
		# open website
		self.driver.get("https://meichu.games")
			
		# check Title is matched or not
		assert "首頁 - 戊戌梅竹 | 2018 Meichu Games" in self.driver.title

		# execute after each test
		print("****** TestCase 1 PASS ******")
		self.driver.close()

if __name__ == "__main__":
	unittest.main()