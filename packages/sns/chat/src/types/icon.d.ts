import { SVGProps } from 'react';

interface IconProps extends SVGProps<SVGSVGElement> {
	size?: number;
	color?: string;
	className?: string;
}

export type { IconProps };
