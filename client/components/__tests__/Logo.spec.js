import { shallowMount } from '@vue/test-utils'
import Logo from '../Logo'

describe('Logo', () => {
  test('mounts properly', () => {
    const wrapper = shallowMount(Logo)
    expect(wrapper.find('div')).toBeTruthy()
  })

  test('renders properly', () => {
    const wrapper = shallowMount(Logo)
    expect(wrapper.html()).toMatchSnapshot()
  })
})
