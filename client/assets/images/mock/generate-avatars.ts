import fs = require('fs')
import crypto = require('crypto')
import childProcess = require('child_process')

const workdir = '/app/'
const mockDir = workdir + 'assets/images/mock/'
const usersDir = 'users/'
const usersEmail = [
  'test@myprofile.pro',
  'test2@myprofile.pro',
  'not-verified@myprofile.pro',
  'admin@myprofile.pro',
  'test_1@myprofile.pro',
  'test_2@myprofile.pro',
  'test_3@myprofile.pro',
  'test_4@myprofile.pro',
  'test_5@myprofile.pro',
  'test_6@myprofile.pro',
  'test_7@myprofile.pro',
  'test_8@myprofile.pro',
  'test_9@myprofile.pro',
  'test_10@myprofile.pro'
]
const userQuantity = usersEmail.length

function md5 (value) {
  return crypto.createHash('md5').update(value).digest('hex')
}

function yarn (options) {
  childProcess.execSync(`yarn ${options}`, { stdio: 'inherit' })
}

yarn(`dicebear create micah --format png --count ${userQuantity}`)

usersEmail.forEach(function (element, index) {
  const userDir = mockDir + usersDir + md5(element)

  if (!fs.existsSync(userDir)) {
    fs.mkdirSync(userDir)
  }

  const oldFile = `${workdir}micah-${index}.png`
  const newFile = `${userDir}/profile.webp`

  fs.rename(oldFile, newFile, function (err) {
    if (err) {
      throw err
    }
  })
})
