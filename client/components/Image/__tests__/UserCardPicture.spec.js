import { shallowMount } from '@vue/test-utils'
import UserCardPicture from '../UserCardPicture'

function factory (index = 0) {
  return shallowMount(UserCardPicture, {
    propsData: {
      index,
      firstName: 'foo_' + index,
      lastName: 'bar_' + index,
      role: 'baz_' + index
    }
  })
}

describe('User card picture component.', () => {
  it('has Card picture component.', () => {
    const wrapper = factory()
    expect(wrapper.find('#UserCardPicture__cardPicture')).toBeTruthy()
  })

  it('has user\'s full name.', () => {
    const wrapper = factory(7)
    expect(wrapper.find('#UserCardPicture__name').text()).toBe('foo_7 bar_7')
  })

  it('has user\'s role.', () => {
    const wrapper = factory(10)
    expect(wrapper.find('#UserCardPicture__role').text()).toBe('baz_10')
  })
})
