import React from 'react';
import { Loader2 } from "lucide-react"
import { Button } from '../../js/components/ui/button';
export const LoadingBtn = (props) =>{
    const {text, ...rest} = props
  return (
    <Button disabled>
      <Loader2 className="animate-spin" />
    {text}
    </Button>
  )
}
