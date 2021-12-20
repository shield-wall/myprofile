import { shallowMount } from '@vue/test-utils'
import CardPicture from '../CardPicture'

function factory () {
  return shallowMount(CardPicture, {
    propsData: {
      profile: '/foo.webp',
      cover: '/bar.webp'
    },
    slots: {
      default: 'baz'
    }
  })
}

describe('Card picture component.', () => {
  it('has cover picture component.', () => {
    const wrapper = factory()
    expect(wrapper.find('#cardPicture__coverPicture')).toBeTruthy()
  })

  it('has profile picture component.', () => {
    const wrapper = factory()
    expect(wrapper.find('#cardPicture__profilePicture')).toBeTruthy()
  })

  it('contains baz into slot.', () => {
    const wrapper = factory()
    expect(wrapper.find('#cardPicture__slotContent').text()).toBe('baz')
  })
})
