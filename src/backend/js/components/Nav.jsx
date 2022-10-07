import React, { Fragment } from 'react';
import { Cog6ToothIcon, KeyIcon, PaintBrushIcon, Squares2X2Icon } from '@heroicons/react/24/outline';

const Nav = ({children}) => {
    return (
        <Fragment>
            <div className="relative bg-white w-full flex items-center md:justify-between justify-start md:flex-row flex-col px-5 py-3">
                <div className="relative flex w-full md:mb-0 mb-2">
                    <span className='mr-2 bg-white cursor-pointer flex items-center p-2 rounded-md border border-slate-400/25 transform translate-y-0 hover:-translate-y-0.5 hover:shadow-lg transition-all duration-200 shadow-slate-200 '>
                        <Squares2X2Icon className="h-5 pointer-events-none text-slate-500 mr-2"/>Dashboard
                    </span>
                    {/* <span className='mr-2 bg-white cursor-pointer flex items-center p-2 rounded-md border border-slate-400/25 transform translate-y-0 hover:-translate-y-0.5 hover:shadow-lg transition-all duration-200 shadow-slate-200 '>
                        <PaintBrushIcon className="h-5 pointer-events-none text-slate-500 mr-2"/>Post Types
                    </span>
                    <span className='mr-2 bg-white cursor-pointer flex items-center p-2 rounded-md border border-slate-400/25 transform translate-y-0 hover:-translate-y-0.5 hover:shadow-lg transition-all duration-200 shadow-slate-200 '>
                        <Cog6ToothIcon className="h-5 pointer-events-none text-slate-500 mr-2"/>Settings
                    </span> */}
                    <span className='mr-2 bg-white cursor-pointer flex items-center p-2 rounded-md border border-slate-400/25 transform translate-y-0 hover:-translate-y-0.5 hover:shadow-lg transition-all duration-200 shadow-slate-200 '>
                        <KeyIcon className="h-5 pointer-events-none text-slate-500 mr-2"/>License
                    </span>
                </div>
                {children}
            </div>
        </Fragment>
    );
}

export default Nav;
