import { shallowMount } from '@vue/test-utils'
import FormRegister from '../FormRegister'

describe('Form register component', () => {
  it('has all fields necessary to register new user.', () => {
    const wrapper = shallowMount(FormRegister)

    expect(wrapper.find('#first-name').exists()).toBeTruthy()
    expect(wrapper.find('#last-name').exists()).toBeTruthy()
    expect(wrapper.find('#email').exists()).toBeTruthy()
    expect(wrapper.find('#password').exists()).toBeTruthy()
    expect(wrapper.find('#repeat-password').exists()).toBeTruthy()
    expect(wrapper.find('#register-button').exists()).toBeTruthy()
  })
})
