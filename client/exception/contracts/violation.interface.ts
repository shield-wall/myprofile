export interface ViolationInterface {
  code: string
  message: string
  propertyPath: string
}

export interface ViolationsInterface {
  violations: ViolationInterface[]
}
